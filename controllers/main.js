const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const router = express.Router();
var popbill = require('popbill');


const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const reserInfo = require('../models/reservation.js');
const smsInfo = require('../models/SMS.js');

const WeGen_conf = require('../helpers/conf.json');

popbill.config({
  LinkID : WeGen_conf.LinkID,
  SecretKey : WeGen_conf.secretKey,
  IsTest : true,
  defaultErrorHandler :  function(Error) {
    console.log('Error Occur : [' + Error.code + '] ' + Error.message);
  }
});

var messageService = popbill.MessageService();

router.get('/',(req,res)=>{
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
            let deskemail = result[0].deskemail;
            let SMSSenderPhoneNo = result[0].SMSSenderPhoneNo;
            let SMSSend = result[0].SMSSend;
            let chkAgree = false;
            let subscriber = count;
            res.render('index',{
              //페이지 식별 정보
              chkAgree : false,
              SMSSend : SMSSend,
              location : location,
              deskemail : deskemail,
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

router.post('/',(req,res,next)=>{
  const name = req.body.name;
  // const email = req.body.email;
  // const patron = req.body.patron;
  const phone = req.body.phone;
  const patron_phone = req.body.patron_phone;
  const chkAgree = req.body.chkAgree ? true : false;

  var data = req.body.data;
  var data1 = req.body.data1;
  var check = req.body.check;
  var check2 = req.body.check2;
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

  console.log("testContents 값 : " + testContents);

  let now = new Date();
  // var check = false;

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
          redirect : '/'
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
                  redirect : '/'
                });
                throw err;
              }
              // res.redirect('/reserva');
          });
        });
        if(check2 == "1") {
          console.log("인증번호 받기 실행 data:" + data1 + " + "+ phone + " + "+ check);
          res.send({result:true, data:data , phone:phone, data1:data1, check:check});
        } else {
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
              redirect : '/'
            });
        });
        // console.log("인증번호 받기 실행 data:" + data1 + " + "+ phone + " + "+ check);
        // res.send({result:true, data:data , phone:phone, data1:data1, check:check});
      }
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
          console.log(patron_phone1 + " 등록 가능 ");
          res.send({result:true});
        } else {
          console.log(patron_phone1 + " 존재하는 phone이 없음 " );
          res.send({result:false});
        }
      });
    } else {
      if(verification == data1){                //인증번호 확인
        verifiCheck = "1";
        console.log("verification = data1 실행 = >" + verification + " = " + data1 + "   check = "+ check);
        res.send({result:true, data1:data1, verification:verification, check:check});
      } else {
        if(check == "1"){
        console.log("verification = data1 실행 X");
        console.log(verification + " != " + data1 + "   check = " + check);
        res.send({result:false, data1:data1, verification:verification});
      } else {
        console.log("Ajax 통신 쪽 끝 다음으로~")
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
          redirect : '/'
        });
      } else {
        if(phone == patron_phone){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '자기자신을 추천인으로 할 수 없습니다.',
            redirect : '/'
          });
        } else {
          if(verification == ''){
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : '인증번호를 확인해주세요.',
              redirect : '/'
            });
          } else {
            if(patron_phone != ''){
              reserInfo.findOne({'phone' : patron_phone}, (err,exist2)=>{
                if(err){
                  throw err;
                }
                if(!exist2){
                  res.render('message',{
                    user : auth.getLoggedUser(req),
                    page_name : '',
                    message : '추천인 전화번호가 등록되있지 않습니다.',
                    redirect : '/'
                  });
                } else {
                  console.log("exist2 : " + exist2);
                  reserInfo.findOne({$and:[{'phone' : patron_phone}, {'patron_phone' : phone}]}, (err,mutual)=>{
                    if(err){
                      throw err;
                    }
                    if(mutual){
                      res.render('message',{
                        user : auth.getLoggedUser(req),
                        page_name : '',
                        message : '상호 추천 불가합니다.',
                        redirect : '/'
                      });
                    } else {
                      reserInfo.count({},(err,count)=>{
                        let indexNo = ++count;
                        sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
                          let info = auth.getEffectDate(sysResult);
                          if(err){
                            throw err;
                          } else {
                            sysInfo.find({effectDate : info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,fnresult)=>{
                              if(err){
                                throw err;
                              } else {
                                if(fnresult != null){
                                  let patron_name = exist2.name;
                                  let location = fnresult[0].location;
                                  console.log("fnresult[0].locaiotn" + location);
                                  console.log(patron_name);
                                  reserInfo.insertMany({
                                    'index' : indexNo,
                                    'phone' : phone,
                                    'name' : name,
                                    'patron_name' : patron_name,
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
                                          redirect : '/index'
                                        });
                                        throw err;
                                      }
                                      res.render('message',{
                                        user : auth.getLoggedUser(req),
                                        page_name : '',
                                        message : '사전예약 완료되었습니다.',
                                        redirect : '/'
                                      });
                                  });
                                }
                              }
                            });
                          }
                      });
                    });
                    }
                  });
                }
              });
            } else {
              reserInfo.count({},(err,count)=>{
                let indexNo = ++count;
                sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
                  let info = auth.getEffectDate(sysResult);
                  if(err){
                    throw err;
                  } else {
                    sysInfo.find({effectDate : info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,fnresult)=>{
                      if(err){
                        throw err;
                      } else {
                        if(fnresult != null){
                          let location = fnresult[0].location;
                          console.log("fnresult[0].locaiotn" + location);
                          reserInfo.insertMany({
                            'index' : indexNo,
                            'phone' : phone,
                            'name' : name,
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
                                  redirect : '/'
                                });
                                throw err;
                              }
                              res.render('message',{
                                user : auth.getLoggedUser(req),
                                page_name : '',
                                message : '사전예약 완료되었습니다.',
                                redirect : '/'
                              });
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
      }
    });
  } else {
    console.log("chkAgree == false");
  }


});

module.exports = router;
