const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const router = express.Router();
var popbill = require('popbill');


const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const reserInfo = require('../models/reservation.js');
const smsInfo = require('../models/SMS.js');

popbill.config({
  LinkID :'FORELINK',
  SecretKey : 'jpI7zBLEphjr3qDFYWRbkhKLw3zODX9okkYs30VC6wk=',
  IsTest : true,
  defaultErrorHandler :  function(Error) {
    console.log('Error Occur : [' + Error.code + '] ' + Error.message);
  }
});

var messageService = popbill.MessageService();

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: 'forelinkg@gmail.com',
      pass: 'forelink10!'
    }
});
var emailSender = 'Gmov <noreply@gmail.com>';
var noreplyTail = '<i><small>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</small></i>';
var notifyViaEmail = true;

router.get('/reserva',(req,res)=>{
  reserInfo.count({},function(err,count){
    if(err){
      throw err;
    } else {
      sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
        let info = auth.getEffectDate(sysResult);
        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
          } else {
            let location = result[0].location;
            let chkAgree = false;
            let subscriber = count;
            res.render('reserva',{
              //페이지 식별 정보
              chkAgree : false,
              location : location,
              subscriber : subscriber,
              page_name : 'reserva',
              message : '포어링크 지역화폐 시스템' // welcome message added by leepg
            });
          }
        });
      });
    }
  });
});

router.post('/reserva',(req,res,next)=>{
  const name = req.body.name;
  // const email = req.body.email;
  // const patron = req.body.patron;
  const phone = req.body.phone;
  const patron_phone = req.body.patron_phone;
  const chkAgree = req.body.chkAgree ? true : false;

  var data = req.body.data;
  var data1 = req.body.data1;
  var check = req.body.check;
  var verification = req.body.verification;   //인증번호 적힌값
  let verifiSave = "0";

  var testCorpNum = '2148687288';
  var sendNum = '01076151015';
  var receiveNum = phone;
  var receiveName = name;
  var contents = '인증번호는 ' + data1 + ' 입니다.';
  var testContents = name + '님의 ' + '인증번호는 ' + data1 + ' 입니다.';
  var reserveDT = '';
  var adsYN = false;

  var patron_phone1 = req.body.patron_phone1;     //추천인 전화번호
  var patronCheck = req.body.patronCheck;

  let now = new Date();

  if (check == "0"){              //인증번호 받기
    reserInfo.findOne({'phone' : phone}, (err,exist)=>{
      if(err){
        throw err;
      }
      if(exist){
        console.log(phone + " already exist");
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '사전예약된 전화번호 입니다.',
          redirect : '/reserva'
        });
      } else {
        smsInfo.count({},(err,count)=>{
          smsInfo.insertMany({
            'phoneNo' : phone,
            'checkNumber' : contents,
            'date' : now.toFormat('YYYY-MM-DD HH24:MI:SS')
          },(err,result)=>{
            if(err){
                res.render('message',{
                  user : auth.getLoggedUser(req),
                  page_name : '',
                  message : '업데이트 도중 문제가 발생하였습니다.',
                  redirect : '/reserva'
                });
                throw err;
              }
              // res.redirect('/reserva');
          });
        });
        messageService.sendSMS(testCorpNum, sendNum, receiveNum, receiveName, contents, reserveDT, adsYN,
          function(receiptNum) {
            // res.render('result', {path : req.path, result : receiptNum});
            console.log("인증번호 받기 실행 data:" + data1 + " + "+ phone + " + "+ check);
            res.send({result:true, data:data , phone:phone, data1:data1, check:check});
          }, function(Error) {
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : 'SMS인증 도중 문제가 발생하였습니다.',
              redirect : '/reserva'
            });
        });
      }
    });
  } else {
    //추천인 전화번호 조회
    if(patronCheck == "1"){
      reserInfo.findOne({'phone' : patron_phone1}, (err,exist)=>{
        if(err){
          throw err;
        }
        if(exist){
          res.send({result:true});
        } else {
          res.send({result:false});
        }
      });
    } else {
      if(verification == data1){                //인증번호 확인
        verifiCheck = "1";
        res.send({result:true, data1:data1, verification:verification, check:check});
      } else {
        if(check == "1"){
        res.send({result:false, data1:data1, verification:verification});
      } else {
        // console.log("Ajax 통신 쪽 끝 사전예약버튼으로~")
      }

      }
    }
  }

  if(chkAgree == true){
    reserInfo.findOne({'phone' : phone}, (err,exist)=>{
      if(err){
        throw err;
      }
      if(exist){
        console.log(phone + " already exist");
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '사전예약된 전화번호 입니다.',
          redirect : '/reserva'
        });
      } else {
        if(phone == patron_phone){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '자기자신을 추천인으로 할 수 없습니다.',
            redirect : '/reserva'
          });
        } else {
          if(verification == ''){
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : '인증번호를 확인해주세요.',
              redirect : '/reserva'
            });
          } else {
            reserInfo.count({},(err,count)=>{
              let indexNo = ++count;
              sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
                let info = auth.getEffectDate(sysResult);
                if(err){
                  throw err;
                }else{
                  sysInfo.find({effectDate : info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,fnresult)=>{
                    if(err){
                      throw err;
                    } else {
                      if(fnresult != null){
                        let location = fnresult[0].location;
                        reserInfo.insertMany({
                          'index' : indexNo,
                          'phone' : phone,
                          'name' : name,
                          'patron_phone' : patron_phone,
                          'chkAgree' : chkAgree,
                          'date' : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                          'dateDay' : now.toFormat('YYYY-MM-DD'),
                          'location' : location
                        },(err,result)=>{
                          if(err){
                              res.render('message',{
                                user : auth.getLoggedUser(req),
                                page_name : '',
                                message : '업데이트 도중 문제가 발생하였습니다.',
                                redirect : '/reserva'
                              });
                              throw err;
                            }
                            res.redirect('/reserva');
                        });
                      }
                    }
                  });
                }
            });
          });
          }
        }
      }
    });
  } else {
    console.log("chkAgree == false");
  }


});

module.exports = router;
