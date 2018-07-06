const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg

const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');

const multichain = require('../middleware/multichain-connection');

const userInfo = require('../models/user.js');
const accountInfo = require('../models/account.js');
const sysInfo = require('../models/systemInfo.js');

const async = require('async');

const WeGen_conf = require('../helpers/conf.json');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: WeGen_conf.smtpGmail,
      pass: WeGen_conf.smtpGmailPwd
    }
});
var emailSender = WeGen_conf.emailSender;
var noreplyTail = '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>';
// var replyTail = '기타 문의사항은 Help desk('+deskemail+')로 문의해주세요.'


router.get('/delete/:addrTag',auth.isLoggedIn,(req,res)=>{

  let addr = req.user.addr;

  if(req.user.isAdmin){
    addr = req.params.addrTag;
  }

  async.waterfall([

    function(callback){
      userInfo.findOne({'isAdmin':true},(err,result)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,result);
        }
      });
    },

    function(admin,callback){
      userInfo.findOne({'addr': addr},(err,result)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,admin,result);
        }
      });
    },

    function(admin,user,callback){
      multichain.getAddressBalances({
        address : user.addr
      },(err,asset)=>{
        if(err){
          callback(true,"multichain_err");
          return;
        }else{
            let qty = wallet.getAddressBalances(asset);

            if(qty > 0){
              multichain.sendAssetFrom({
                from : user.addr,
                to : admin.addr,
                asset : WeGen_conf.assetname,
                qty : qty
              },(sendErr,sendAsset)=>{
                if(sendErr){
                  callback(true,"multichain_err");
                  return;
                }else{
                  multichain.getAddressBalances({address : user.addr},(fromErr,fromResult)=>{
                    if(fromErr){
                      throw fromErr;
                    }else{
                      multichain.getAddressBalances({address : admin.addr},(toErr,toResult)=>{
                        if(toErr){
                          throw toErr;
                        }else{
                          let fromBalance = wallet.getAddressBalances(fromResult);
                          let toBalance = wallet.getAddressBalances(toResult);
                          let now = new Date();
                          let account = [{
                            from : user.email,
                            to : admin.email,
                            input : "",
                            output : String(qty),
                            memo : "회원탈퇴",
                            date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                            balance : Number(fromBalance)
                          },{
                            from : admin.email,
                            to : user.email,
                            input : String(qty),
                            output : "",
                            memo : "회원탈퇴",
                            date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                            balance : Number(toBalance)
                          }];

                          accountInfo.insertMany(account,(err,result)=>{
                            if(err){
                              throw err
                            }else{
                              console.log("ledger successfully recorded");
                            }
                          })
                        }
                      });
                    }
                  });

                  callback(null,user);
                }
              });
            }else{
              callback(null,user);
            }
          }
      });
    },

    function(user,callback){
      userInfo.update({'addr':user.addr},{$set:{'disabled':true}},(err,res)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          callback(null,user);
        }
      });
    }

  ],function(err,result){
    if(result == "mongodb_err"){
      console.log("mongodb error");
    }else if(result == "multichain_err"){
      console.log("multichain error");
    }else{
      sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
        let info = auth.getEffectDate(result);
        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : 'DB조회중 오류가 발생하였습니다.',
              redirect : '/'
            });

          }else{
            if(result==null){
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : 'DB조회 결과가 없습니다.',
                redirect : '/'
              });
            }else{
              let deskemail = result[0].deskemail;

              var rmMailOptions = {
                from : emailSender,
                to : result.name + '<' + result.email + '>',
                subject : 'CGM코인 \' 회원탈퇴 \' 알림 메일입니다',
                html : 'CGM코인에서 탈퇴되었습니다.<br>' +
                       '<br>' + noreplyTail + '<br>' + '기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                text : 'CGM코인에서 탈퇴되었습니다.'
              };

              smtpTransport.sendMail(rmMailOptions, (rmEmailErr, rmEmailRes)=>{
                if(rmEmailErr){
                  console.log(rmEmailErr);
                }else{
                  console.log("message sent to " + result.email + " : " + rmEmailRes.message);
                }
              });

              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : '회원탈퇴가 정상적으로 처리되었습니다.',
                redirect : '/'
              });
            }
          }
        })
      })
    }
  });
});


module.exports = router;
