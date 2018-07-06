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


router.get('/delete',auth.isLoggedIn,(req,res)=>{
  let userId = req.user.id; // unsubscribe by user
  let unsubscribeByUser = true;
  if(req.query.id){         // delete by admin
    userId = req.query.id;
    unsubscribeByUser = false;
  }
  if(unsubscribeByUser == false && req.user.id !== 'admin'){ // for security
    res.render('message', {
      user : req.user.id,
      message : '관리자만 사용자 계정을 삭제할 수 있습니다.',
      redirect : '/delete'
    });
    return;
  }
  //console.log(userId);

  var errOnRemainAsset = false;     // error on remain asset
  var sendAssetToAdmin = true;      // send remain asset to admin
  var deleteNoti = true;            // noti on delete by admin
  var unsubscribeNoti = true;       // noti on unsubscribe by user
  var removeUserAndAccount = true;  // false for test
  if(removeUserAndAccount != true){
    errOnRemainAsset = false;
    sendAssetToAdmin = false;
  }

  const admId = 'admin';

  userInfo.findOne({'id' : admId},(admErr,admResult)=>{
    if(admErr){
      console.log(admErr);
      throw admErr;
    }
    const admAddr = admResult.addr;
    const admName = admResult.name;
    const admEmail = admResult.email;
    const admRxnoti = admResult.rxnoti;

    userInfo.findOne({'id' : userId},(userErr,userResult)=>{
      if(userErr){
        console.log(userErr);
        throw userErr;
      }
      const userAddr = userResult.addr;
      const userName = userResult.name;
      const userEmail = userResult.email;
      const userTxnoti = userResult.txnoti;

      multichain.getAddressBalances({
        address : userAddr
      }, (userBalErr,userAsset)=>{
        if(userBalErr){
          console.log(userBalErr);
          throw userBalErr;
        }
        let qty = 0;
        if(!wallet.isEmpty(userAsset)){
          qty = userAsset[0]['qty']
        }
        if(qty <= 0){
          console.log(userId + ' has no asset');
        }else if(errOnRemainAsset){
          console.log(userId + ' has asset and can\'t not be deleted');
          if(unsubscribeByUser){
            errMessage = '잔고가 남아 있습니다. 다른 사용자에게 이체후 탈퇴하세요.';
          }else{
            errMessage = '사용자가 코인을 보유하고 있습니다. 잔고가 없는 사용자만 삭제할 수 있습니다.';
          }
          res.render('message', {
            user : req.user.id,
            message : errMessage,
            redirect : '/delete'
          });
          return;
        }else if(sendAssetToAdmin){
          const memo = '회원 탈퇴';
          let now = new Date();
          multichain.getAddressBalances({address : admAddr},(admBalErr,admAsset)=>{
            if(admBalErr){
              console.log(admBalErr);
              throw admBalErr;
            }
            let userBalance = auth.getAddressBalances(userAsset);
            let admBalance = auth.getAddressBalances(admAsset);
            console.log('admAsset = ' + admBalance);
            console.log(admAsset);
            multichain.sendAssetFrom({
              from : userAddr,
              to : admAddr,
              asset : "cgmcoin",
              qty : qty}, (sendErr,sendData)=>{
              if(!sendErr){
                console.log('reassign ' + userName + '(' + userId + ')' + '\'s ' + qty + ' to ' + admName);
                let account =[{
                  from : userId,
                  to : admId,
                  input : "",
                  output : String(qty),
                  memo : memo,
                  date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                  balance : Number(userBalance) - qty
                },{
                  from : admId,
                  to : userId,
                  input : String(qty),
                  output : "",
                  memo : memo,
                  date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                  balance : Number(admBalance) + qty
                }];
                accountInfo.insertMany(account,(hisErr,hisResult)=>{
                  if(hisErr){
                    throw hisErr;
                  }
                  console.log("Account has successfully saved");
                });
                if(userTxnoti){
                  var fromMailOptions = {
                    from : emailSender,
                    to : userName + '<' + userEmail + '>',
                    subject : '나눔코인 \'송금\' 알림 메일입니다',
                    html : '나눔코인 <b>' + qty + '원</b>이 ' + admName + '님에게 전송되었습니다.<br>' +
                           '<br>' + noreplyTail,
                    text : '나눔코인 ' + qty + '원이 ' + admName + '님에게 전송되었습니다.'
                  };
                  smtpTransport.sendMail(fromMailOptions, function(fromEmailErr, fromEmailRes){
                    if(fromEmailErr){
                      console.log(fromEmailErr);
                    }else{
                      console.log("message sent to " + userEmail + " : " + fromEmailRes.message);
                      //smtpTransport.close();
                    }
                  });
                }
                if(admRxnoti){
                  var toMailOptions = {
                    from : emailSender,
                    to : admName + '<' + admEmail + '>',
                    subject : '나눔코인 \'입금\' 알림 메일입니다',
                    html : userName + '님으로부터 나눔코인 <b>' + qty + '원</b>이 입금되었습니다.<br>' +
                           '<br>' + noreplyTail,
                    text : userName + '님으로부터 나눔코인' + qty + '원이 입금되었습니다.'
                  };
                  smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                    if(toEmailErr){
                      console.log(toEmailErr);
                    }else{
                      console.log("message sent to " + admEmail + " : " + toEmailRes.message);
                      //smtpTransport.close();
                    }
                  });
                }
              }else{
                console.log(sendErr);
                throw sendErr;
              }
            });
          });
        } // check user Asset and sendAsset
        // TODO: async issue
        if(removeUserAndAccount){ // false for test
          accountInfo.remove({'from':userId}).exec((rmHisErr,rmHisResult)=>{
            if(rmHisErr){
              console.log(rmHisErr);
              //throw rmHisErr; // no removed data also error
            }
            console.log(userId + ' account info removed');
          });
          // TODO: async issue
          userInfo.remove({'id':userId}).exec((rmErr,rmResult)=>{
            if(rmErr){
              console.log(rmErr);
              throw rmErr;
            }
            if((unsubscribeByUser == true && unsubscribeNoti == true) ||
               (unsubscribeByUser == false && deleteNoti == true)){
              var rmMailOptions = {
                from : emailSender,
                to : userName + '<' + userEmail + '>',
                subject : '나눔코인 \'회원 탈퇴\' 알림 메일입니다',
                html : '나눔코인에서 탈퇴되었습니다.<br>' +
                       '<br>' + noreplyTail,
                text : '나눔코인에서 탈퇴되었습니다.'
              };
              smtpTransport.sendMail(rmMailOptions, function(rmEmailErr, rmEmailRes){
                if(rmEmailErr){
                  console.log(rmEmailErr);
                }else{
                  console.log("message sent to " + userEmail + " : " + rmEmailRes.message);
                  //smtpTransport.close();
                }
              });
            }
          });
        }

        if(!unsubscribeByUser){ // delete/unsubscribe by admin
          id = req.query.id;
          console.log(userId + ' deleted by admin');
          res.render('message', {
            user : req.user.id,
            message : '삭제되었습니다.',
            redirect : '/'
          });
        }else{ // unscribe by user
          console.log(userId + ' unsubscribed');
          req.logout();
          res.render('message', {
            message : '탈퇴되었습니다.',
            redirect : '/'
          });
          //s.redirect('/');
        }
      });
    });
  });
});
// added by leepg for user unsubscribe - end

module.exports = router;
