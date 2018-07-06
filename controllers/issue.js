const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const date = require('date-utils');
const router = express.Router();

const async = require('async');

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');

const multichain = require('../middleware/multichain-connection');
const userInfo = require('../models/user.js');
const accountInfo = require('../models/account.js');
const sysInfo = require('../models/systemInfo.js');

const WeGen_conf = require('../helpers/conf.json');
const logger = require('../middleware/winston.js');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: WeGen_conf.smtpGmail,
      pass: WeGen_conf.smtpGmailPwd
    }
});
var emailSender = WeGen_conf.emailSender;
var noreplyTail = '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>';


router.get('/issue',auth.isAdmin,(req,res)=>{

  async.waterfall([
    function(callback){
      userInfo.find({'disabled':false}).sort({'id':1}).exec((err,result)=>{
        if(err){
          throw err;
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,result);
        }
      });
    },

    function(user,callback){
      userInfo.findOne({'isAdmin':true},(err,adminAddr)=>{
        if(err){
          throw err;
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,user,adminAddr);
        }
      });
    },

    function(user,addr,callback){

      sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
        if(err){
          console.log(err);
          callback(true,"mongodb_err");
          return;
        }else{
          let renderData;

          if(result == null){
            renderData = {
              adminAddr : addr.addr,
              icoType : '',
              result : user
            }

            callback(null,renderData);
            return;
          }else{
            let info = auth.getEffectDate(result);

            sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
              if(err){
                console.log(err);
                callback(true,"mongodb_err");
                return;
              }else{
                if(result != null){
                  renderData = {
                    adminAddr : addr.addr,
                    icoType : result[0].icoType,
                    result : user
                  }
                }else{
                  renderData = {
                    adminAddr : addr.addr,
                    icoType : '',
                    result : user
                  }
                }

                callback(null,renderData);
                return;
              }
            });
          }
        }
      });
    }
  ],function(err,result){
    if(result == "mongodb_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "사용자 정보를 조회 할 수가 없습니다.",
        redirect : '/issue'
      });
    }else{
      res.render('issue',{
        adminAddr : result.adminAddr,
        icoType : result.icoType,
        user : auth.getLoggedUser(req),
        page_name : 'issue'
      });
    }
  });
});


router.post('/issue',auth.isLoggedIn,(req,res)=>{
  const email = req.body.emailTag;
  const amount = req.body.amount;
  const qty = Number(amount);
  const adminAddr = req.body.adminAddr;
  const icoType = req.body.icoType;
  const memo = req.body.memo;
  const issuer = auth.getLoggedUser(req).email;

  async.waterfall([
    function(callback){
      if(isNaN(qty)){
        callback(true,'wrongParam');
        return;
      }

      callback(null);
    },

    function(callback){
      userInfo.findOne({'email' : email,'disabled':false},(err,toResult)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          if(toResult == null){
            userInfo.findOne({'addr' : email,'disabled':false},(err,toResult)=>{
              if(err){
                callback(true,"mongodb_err");
                return;
              }else{
                if(toResult == null){
                  callback(true,"mongodb_null");
                  return;
                }else{
                  callback(null,toResult);
                  return;
                }
              }
            });
          }else{
            callback(null,toResult);
          }
        }
      })
    },

    function(to,callback){

      sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
        if(err){
          throw err;
        }else{
          if(result != null){
            let info = auth.getEffectDate(result);

            sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
              if(err){
                throw err;
              }else{
                if(result != null){
                  callback(null,to,result[0]);
                }else{
                  callback(true,"mongodb_null");
                  return;
                }
              }
            });
          }else{
            callback(true,"mongodb_null");
            return;
          }
        }
      });
    },

    function(to,sysInfo,callback){
      multichain.issueMoreFrom({
        from : adminAddr,
        to : to.addr,
        asset : WeGen_conf.assetname,
        qty : qty
      },(err,data)=>{
        if(err){
          callback(true,"multichain_err");
          return;
        }else{
          multichain.getAddressBalances({address : to.addr},(err,toResult)=>{
            if(err){
              callback(true,"multichain_err");
            }else{
              let balance = wallet.getAddressBalances(toResult);
              let now = new Date();

              let account = [{
                from : email,
                to : issuer,
                input : qty,
                output : "",
                description : icoType,
                memo : memo,
                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                balance : Number(balance),
              },{
                from : issuer,
                to : email,
                input : "",
                output : qty,
                description : icoType,
                memo : memo,
                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                balance : "",
              }];

              callback(null,to,account);
            }
          });
        }
      });
    },

    function(to,account,callback){
      accountInfo.insertMany(account,(err,saveResult)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,to);
        }
      })
    }

  ],function(err,result){
    if(result == "mongodb_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "MongoDB 에러가 발생하였습니다.",
        redirect : '/issue'
      });
    }else if(result == "mongodb_null"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "사용자 검색 결과가 없습니다.",
        redirect : '/issue'
      });
    }else if(result == "multichain_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "Multichain 에러가 발생하였습니다.",
        redirect : '/issue'
      });
    }else if(result == "wrongParam"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "금액을 잘못 입력하였습니다.",
        redirect : '/issue'
      });
    }else{

      sysInfo.find({}).sort({effectDate:-1}).exec((err,sysResult)=>{
        let info = auth.getEffectDate(sysResult);
        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,sysData)=>{
          if(err){
            throw err;
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : "MongoDB 에러가 발생하였습니다.",
              redirect : '/issue'
            });
          }else{
            if(result==null){
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : "MongoDB 조회 결과가 없습니다.",
                redirect : '/issue'
              });
            }else{
              if(req.user.issuenoti){
                var fromMailOptions = {
                  from : emailSender,
                  to : req.user.name + '<' + req.user.email + '>',
                  subject : '나눔코인 \'화폐 발행\' 알림 메일입니다',
                  html : '나눔코인 <b>' + qty + '원</b>이 ' + result.name + '님에게 발행되었습니다.<br>' +
                         '<br>' + noreplyTail +'<br>기타 문의사항은 Help desk로 문의해주세요.->'+sysData[0].deskemail,
                  text : '나눔코인 ' + qty + '원이 ' + result.name + '님에게 발행되었습니다.'
                };
                smtpTransport.sendMail(fromMailOptions, function(fromEmailErr, fromEmailRes){
                  if(fromEmailErr){
                    console.log(fromEmailErr);
                  }else{
                    console.log("message sent to " + req.user.email + " : " + fromEmailRes.message);
                    //smtpTransport.close();
                  }
                });
              }
              console.log("check"+result);
              if(result.rxnoti){
                var toMailOptions = {
                  from : emailSender,
                  to : result.name + '<' + result.email + '>',
                  subject : '나눔코인 \'입금\' 알림 메일입니다',
                  html : req.user.name + '님으로부터 나눔코인 <b>' + qty + '원</b>이 입금되었습니다.<br>' +
                         '<br>' + noreplyTail +'<br>기타 문의사항은 Help desk로 문의해주세요.->'+sysData[0].deskemail,
                  text : req.user.name + '님으로부터 나눔코인' + qty + '원이 입금되었습니다.'
                };
                smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                  if(toEmailErr){
                    console.log(toEmailErr);
                  }else{
                    console.log("message sent to " + result.email + " : " + toEmailRes.message);
                    //smtpTransport.close();
                  }
                });
              }

              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : '토큰 발급이 정상적으로 처리되었습니다.',
                redirect : '/issue'
              });
            }
          }
        })
      })
    }
  });
});


module.exports = router;
