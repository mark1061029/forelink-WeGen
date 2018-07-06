const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg

const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');

const multichain = require('../middleware/multichain-connection');

const userInfo = require('../models/user.js');
const accountInfo = require('../models/account.js');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: 'forelinkg@gmail.com',
      pass: 'forelink10!'
    }
});
var emailSender = '운영자 <noreply@gmail.com>';
var noreplyTail = '<i><small>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</small></i>';


router.get('/sendAsset',auth.isLoggedIn,(req,res)=>{

  userInfo.findOne({'id' : req.user.id},(err,result)=>{

    const addr = result.addr;
    const id = result.id;

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
          redirect : '/'
        });
      }else{
        multichain.getAddressBalances({address : addr},(err,result)=>{
          if(err){
            throw err;
          }

          let qty = wallet.getAddressBalances(result);
          if(qty <= 0){
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : '잔고가 없습니다. 충전을 하시려면 운영자에게 연락 바랍니다',
              redirect : '/'
            });
          }else{
            res.render('sendAsset',{
              fromId : req.user.id,
              user : auth.getLoggedUser(req),
              qty : qty,
              page_name : 'sendAsset'
            });
          }
        });
      }
    });
  })
});


router.post('/sendAsset',(req,res)=>{
  const fromId = req.body.hiddenId;
  const toId = req.body.toId;
  const amount = req.body.amount;
  const memo = req.body.memo;

  const qty = Number(amount);

  let now = new Date();

  userInfo.findOne({'id' : fromId},(err,fromResult)=>{
    if(err){
      throw err;
    }
    userInfo.findOne({'id': toId},(err,toResult)=>{
      if(err){
        throw err;
      }
      if(!toResult){ // added by leepg to avoid abort
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '존재하지 않는 입금자입니다.',
          redirect : '/sendAsset'
        });
      }else if(toId === fromId){ // added by leepg
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '입금자 명이 출금자 명과 동일합니다.',
          redirect : '/sendAsset'
        });
      }else{
        const fromAddr = fromResult.addr;
        const toAddr = toResult.addr;

        multichain.getAddressBalances({address : fromAddr},(err,chainFromResult)=>{
          if(err){
            throw err;
          }
          multichain.getAddressBalances({address : toAddr},(err,chainToResult)=>{
            if(err){
              throw err;
            }
            let fromBalance = wallet.getAddressBalances(chainFromResult);
            let toBalance = wallet.getAddressBalances(chainToResult);
            if(amount > fromBalance){ // added by leepg
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : '잔액이 부족합니다. 충전을 하시려면 운영자에게 연락 바랍니다',
                redirect : '/sendAsset'
              });
            }else{
              multichain.sendAssetFrom({
                from : fromAddr,
                to : toAddr,
                asset : "cgmcoin",
                qty : qty},
                (err,data)=>{
                  if(!err){
                    // flow changed by leepg because mongodb updated on receiver no perm error - begin
                    let account =[{
                      from : fromId,
                      to : toId,
                      input : "",
                      output : amount,
                      transaction : "",
                      memo : memo,
                      date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                      balance : Number(fromBalance) - qty
                    },{
                      from : toId,
                      to : fromId,
                      input : amount,
                      output : "",
                      transaction : "",
                      memo : memo,
                      date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                      balance : Number(toBalance) + qty
                    }];

                    accountInfo.insertMany(account,(err,result)=>{
                      if(err){
                        throw err;
                      }
                      console.log("Account has successfully saved");
                    });
                    // flow changed by leepg because mongodb updated on receiver no perm error - end

                    // added by leepg for email noti - begin
                    if(fromResult.txnoti){
                      var fromMailOptions = {
                        from : emailSender,
                        to : fromResult.name + '<' + fromResult.email + '>',
                        subject : '나눔코인 \'송금\' 알림 메일입니다',
                        html : '나눔코인 <b>' + qty + '원</b>이 ' + toResult.name + '님에게 전송되었습니다.<br>' +
                               '<br>' + noreplyTail,
                        text : '나눔코인 ' + qty + '원이 ' + toResult.name + '님에게 전송되었습니다.'
                      };
                      smtpTransport.sendMail(fromMailOptions, function(fromEmailErr, fromEmailRes){
                        if(fromEmailErr){
                          console.log(fromEmailErr);
                        }else{
                          console.log("message sent to " + fromResult.email + " : " + fromEmailRes.message);
                          //smtpTransport.close();
                        }
                      });
                    }
                    if(toResult.rxnoti){
                      var toMailOptions = {
                        from : emailSender,
                        to : toResult.name + '<' + toResult.email + '>',
                        subject : '나눔코인 \'입금\' 알림 메일입니다',
                        html : fromResult.name + '님으로부터 나눔코인 <b>' + qty + '원</b>이 입금되었습니다.<br>' +
                               '<br>' + noreplyTail,
                        text : fromResult.name + '님으로부터 나눔코인' + qty + '원이 입금되었습니다.'
                      };
                      smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                        if(toEmailErr){
                          console.log(toEmailErr);
                        }else{
                          console.log("message sent to " + toResult.email + " : " + toEmailRes.message);
                          //smtpTransport.close();
                        }
                      });
                    }
                    // added by leepg for email noti - end

                    res.render('message',{
                      user : auth.getLoggedUser(req),
                      page_name : '',
                      message : '이체가 정상적으로 이루어졌습니다.',
                      redirect : '/myWallet'
                    });
                  }else if(err.code == -704){ // added by leepg to avoid abort
                    res.render('message',{
                      user : auth.getLoggedUser(req),
                      page_name : '',
                      message : '입금자에게 수신 권한이 없습니다.',
                      redirect : '/sendAsset'
                    });
                  }else{
                    console.log(err);
                    throw err;
                  }
                }
              );
            }
          });
        });
      }
    });
  });
});

module.exports = router;
