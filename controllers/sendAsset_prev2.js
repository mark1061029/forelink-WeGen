const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const async = require('async');

const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');

const multichain = require('../middleware/multichain-connection');

const userInfo = require('../models/user.js');
const accountInfo = require('../models/account.js');
const sysInfo = require('../models/systemInfo.js');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: 'forelinkg@gmail.com',
      pass: 'forelink10!'
    }
});
var emailSender = 'Gmov <noreply@gmail.com>';
var noreplyTail = '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>';


router.get('/sendAsset',auth.isLoggedIn,(req,res)=>{

  userInfo.findOne({'addr' : req.user.addr},(err,result)=>{

    const addr = result.addr;

    multichain.listPermissions({addresses : addr},(err,data)=>{
      if(err){
        throw err;
      }
      //console.log(data);
      let hasSendPermission = false;
      for(let index in data){
        for(let key in data[index]){
          if(key == 'type' && data[index][key] == 'send'){
            hasSendPermission = true;
            break;
          }
        }
      }
      if(!hasSendPermission){
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '송금 권한이 없습니다. 운영자에게 문의하세요.',
          redirect : '/sendAsset'
        });
      }else{
        multichain.getAddressBalances({address : addr},(err,result)=>{
          if(err){
            throw err;
          }

          let qty = wallet.getAddressBalances(result);
          if(qty <= 0){
            res.render('sendAsset',{
              fromEmail : req.user.email,
              user : auth.getLoggedUser(req),
              qty : 0,
              page_name : 'sendAsset'
            });
          }else{
            res.render('sendAsset',{
              fromEmail : req.user.email,
              user : auth.getLoggedUser(req),
              qty : wallet.thousandComma(qty),
              page_name : 'sendAsset'
            });
          }
        });
      }
    });
  })
});


router.post('/sendAsset',(req,res)=>{
  const fromEmail = req.body.fromEmail;
  const toEmail = req.body.toEmail;
  const amount = req.body.amount;
  const memo = req.body.memo;

  const qty = Number(amount);

  let now = new Date();

  async.waterfall([
    function(callback){
      userInfo.findOne({'email':fromEmail},(err,fromResult)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          if(fromResult == null){
            callback(true,"mongodb_null");
            return;
          }else{
            callback(null,fromResult);
          }
        }
      });
    },

    function(fromResult,callback){
      userInfo.findOne({'email': toEmail,'disabled':false},(err,toResult)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          if(toResult == null){
            userInfo.findOne({'addr':toEmail,'disabled' : false},(err,toResult)=>{
              if(err){
                callback(true,"mongodb_err");
                return;
              }else{
                if(toResult == null){
                  callback(true,"mongodb_null");
                  return;
                }else{
                  callback(null,fromResult,toResult);
                  return;
                }
              }
            });
          }else{
            callback(null,fromResult,toResult);
            return;
          }
        }
      });
    },
    function(from,to,callback){
      multichain.getAddressBalances({address : from.addr},(err,fromAsset)=>{
        if(err){
          callback(true,"multichain_err");
          return;
        }else{
          multichain.getAddressBalances({address: to.addr},(err,toAsset)=>{
            if(err){
              callback(true,"multichain_err");
              return;
            }else{

              let fromBalance = wallet.getAddressBalances(fromAsset);

              if(amount > fromBalance){
                callback(true,"no_balance");
                return;
              }else{
                callback(null,from,to);
              }
            }
          });
        }
      });
    },

    function(from,to,callback){
      multichain.sendAssetFrom({
        from : from.addr,
        to: to.addr,
        asset : "cgmcoin",
        qty : qty
      },(err,data)=>{
        if(err){
          callback(true,"multchain_err");
          return;
        }else{
          callback(null,from,to);
        }
      });
    },

    function(from,to,callback){
      multichain.getAddressBalances({address : from.addr},(err,fromAsset)=>{

        if(err){
          callback(true,"multichain_err");
          return;
        }else{
          multichain.getAddressBalances({address : to.addr},(err,toAsset)=>{

            if(err){
              callback(true,"multichain_err");
            }else{
              let fromBalance = wallet.getAddressBalances(fromAsset);
              let toBalance = wallet.getAddressBalances(toAsset);

              let account = [{
                from : from.email,
                to : to.email,
                input : "",
                output : amount,
                description : "이체",
                memo : memo,
                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                balance : Number(fromBalance)
              },{
                from : to.email,
                to : from.email,
                input : amount,
                output : "",
                description : "이체",
                memo : memo,
                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                balance : Number(toBalance)
              }];

              callback(null,from,to,account);
            }
          });
        }
      });
    },

    function(from,to,account,callback){
      accountInfo.insertMany(account,(err,result)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
            let info = auth.getEffectDate(result);
            sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
              if(err){
                callback(true,"mongodb_err");
                return;
              }else{
                if(result==null){
                  callback(true,"mongodb_null");
                  return;
                }else{
                  let deskemail = result[0].deskemail;

                  if(from.txnoti){
                    var fromMailOptions = {
                      from : emailSender,
                      to : from.name + '<' + from.email + '>',
                      subject : '나눔코인 \'송금\' 알림 메일입니다',
                      html : '나눔코인 <b>' + qty + '원</b>이 ' + to.name + '님에게 전송되었습니다.<br>' +
                             '<br>' + noreplyTail +'기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                      text : '나눔코인 ' + qty + '원이 ' + to.name + '님에게 전송되었습니다.'
                    };
                    smtpTransport.sendMail(fromMailOptions, function(fromEmailErr, fromEmailRes){
                      if(fromEmailErr){
                        console.log(fromEmailErr);
                      }else{
                        console.log("message sent to " + from.email + " : " + fromEmailRes.message);
                        //smtpTransport.close();
                      }
                    });
                  }

                  if(to.rxnoti){
                    var toMailOptions = {
                      from : emailSender,
                      to : to.name + '<' + to.email + '>',
                      subject : '나눔코인 \'입금\' 알림 메일입니다',
                      html : from.name + '님으로부터 나눔코인 <b>' + qty + '원</b>이 입금되었습니다.<br>' +
                             '<br>' + noreplyTail +'기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                      text : from.name + '님으로부터 나눔코인' + qty + '원이 입금되었습니다.'
                    };
                    smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                      if(toEmailErr){
                        console.log(toEmailErr);
                      }else{
                        console.log("message sent to " + to.email + " : " + toEmailRes.message);
                        //smtpTransport.close();
                      }
                    });
                  }

                  callback(null,"success");
                }
              }
            });
          });
        }
      });
    }

  ],function(err,result){
    if(result == "mongodb_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "MongoDB 에러가 발생하였습니다.",
        redirect : '/sendAsset'
      });
    }else if(result == "mongodb_null"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "올바른 입금자가 아니거나 입금자 주소가 틀립니다.",
        redirect : '/sendAsset'
      });
    }else if(result == "multichain_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "Multichain 에러가 발생하였습니다.",
        redirect : '/sendAsset'
      });
    }else if(result == "no_balance"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "자금이 부족합니다.",
        redirect : '/sendAsset'
      });
    }else{
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "이체가 정상적으로 이루어졌습니다.",
        redirect : '/myWallet/' + req.user.addr
      });
    }
  });
});

module.exports = router;
