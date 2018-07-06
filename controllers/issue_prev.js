const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const date = require('date-utils');
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


router.get('/issue',auth.isAdmin,(req,res)=>{
  //userInfo.find({},(err,result)=>{ // sort function added by leepg
  userInfo.find({}).sort({'id':1}).exec((err,result)=>{
    if(err){
      throw err;
    }

    userInfo.findOne({'id':'admin'},(err,adminAddr)=>{
      if(err){
        throw err;
      }else{

        res.render('issue',{
            result : result,
            adminAddr : adminAddr.addr,
            user : auth.getLoggedUser(req),
            page_name : 'issue'
        });
      }
    });
  });
});

router.post('/issue',(req,res)=>{
  const id = req.body.addrTag;
  const amount = req.body.amount;
  const qty = Number(amount);
  const adminAddr = req.body.adminAddr;

  userInfo.findOne({'id' : id}, (err,toResult)=>{
    if(err){
      throw err;
    }

    const addr = toResult.addr;

    multichain.issueMoreFrom({
      from : adminAddr, // CUSTOMIZE
      to : addr,
      asset : 'cgmcoin',
      qty : qty
    },(err,data)=>{
      if(!err){
        // added by leepg for transaction hostory - begin
        multichain.getAddressBalances({address : addr},(err,toResult)=>{
          if(err){
            console.log("getAddressBalances(" + addr + ") failed"); // throw err;
          }else{
            const fromId = req.user.id;
            const memo = "화폐 발행";
            let balance = wallet.getAddressBalances(toResult);
            let now = new Date();
            let account =[{
              from : id,
              to : fromId,
              input : amount,
              output : "",
              memo : memo,
              date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
              balance : Number(balance)
            }];
            console.log("id = " + id + "(" + addr + ") balance = " + balance + "(+ " + amount + "/" + qty + ")");
            accountInfo.insertMany(account,(err,saveResult)=>{
              if(err){
                console.log("Account save failed");
              }else{
                console.log("Account has successfully saved");
                console.log(account);
              }
            });
          }
        });
        // added by leepg for transaction hostory - end

        // added by leepg for email noti - begin
        if(req.user.issuenoti){
          var fromMailOptions = {
            from : emailSender,
            to : req.user.name + '<' + req.user.email + '>',
            subject : '나눔코인 \'화폐 발행\' 알림 메일입니다',
            html : '나눔코인 <b>' + qty + '원</b>이 ' + toResult.name + '님에게 발행되었습니다.<br>' +
                   '<br>' + noreplyTail,
            text : '나눔코인 ' + qty + '원이 ' + toResult.name + '님에게 발행되었습니다.'
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
        if(toResult.rxnoti){
          var toMailOptions = {
            from : emailSender,
            to : toResult.name + '<' + toResult.email + '>',
            subject : '나눔코인 \'입금\' 알림 메일입니다',
            html : req.user.name + '님으로부터 나눔코인 <b>' + qty + '원</b>이 입금되었습니다.<br>' +
                   '<br>' + noreplyTail,
            text : req.user.name + '님으로부터 나눔코인' + qty + '원이 입금되었습니다.'
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

        res.redirect('/address');
      }else if(err.code == -704){ // added by leepg to avoid abort
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '대상자에게 수신 권한이 없습니다.'
        });
      }else{
        console.log(err);
        throw err;
      }
    });
  })
});

module.exports = router;
