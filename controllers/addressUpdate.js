const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const router = express.Router();
const swal = require('sweetalert2');

const async = require('async');

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');

router.post('/addressUpdate',auth.isLoggedIn,(req,res)=>{
  const addr = req.body.multiAddr;
  const ethAddr = req.body.ethAddr;
  const name= req.body.name;  // added by leepg for name update
  const pwd = req.body.pwd;   // added by leepg for passwd update
  const pwd2 = req.body.pwd2; // added by leepg for passwd update
  const phone = req.body.phone;
  const email = req.body.email;
  const rxnoti = (req.body.rxnoti && req.body.rxnoti === 'true') ? true : false;
  const txnoti = (req.body.txnoti && req.body.txnoti === 'true') ? true : false;
  const issuenoti = (req.body.issuenoti && req.body.issuenoti === 'true') ? true : false;

  let otpCheck = (req.body.otpCheck && req.body.otpCheck === true ) ? true : false;

  let user = new userInfo();

  // - mongodb schema can be changed at run time. update flow with new schema is
  //   insert new one -> all fields copied -> init new field -> remove old one...
  // - find() with new schema & old data, new field set by default value defined by schema

  async.waterfall([

    //패스워드 확인
    function(callback){
      if(pwd || pwd2){
        if(!pwd || !pwd2 || pwd !== pwd2){
          console.log('passwords do not match');

          callback(true, 'wrongPwd');
          return;
        }
      }
      callback(null);
    },

    //email 중복 확인
    function(callback){
      userInfo.findOne({'email' : email},(err,emailInfo)=>{
        if(err){
          throw err;
        }else{
          if((emailInfo != null) && (emailInfo.addr != addr)){
            callback(true,'emailExist');
            return;
          }else{
            callback(null);
            return;
          }
        }
      });
    },

    function(callback){
      let rndKey = null;

      //2018.03.07 윤성규
      //운영자의 경우 otp를 사용하므로 otp를 유지하는 코드 구성
      //otp작업이 미완성이므로 아래의 코드는 임시방편.


      userInfo.findOne({'addr':addr,isAdmin:true},(err,result)=>{
        if(err){
          throw err;
        }else{
          if(result == null){
            callback(null,rndKey);
          }else{
            rndKey = result.otpKey;
            otpCheck = true;

            callback(null,rndKey);
          }
        }
      });
    },
    function(rndKey,callback){
      userInfo.update({'addr' : addr},{
        name : name,
        phone : phone,
        email : email,
        rxnoti : rxnoti,
        txnoti : txnoti,
        issuenoti : issuenoti,
        otpCheck : otpCheck,
        otpKey : rndKey,
        ethAddr : ethAddr
      },(err,result)=>{
        if(err){
          throw err;
        }

        if(pwd){
          userInfo.update({'addr' : addr},{
            pwd : user.generateHash(pwd),
          },(pwdErr, pwdResult)=>{
            if(pwdErr){
              throw pwdErr;
            }
            console.log("passwd changed to '" + pwd +"'");
          });
        }

        console.log('userinfo update completed !!!');

        callback(null,"updated1");
      });
    }
  ],function(err,result){
    if(result == 'wrongPwd'){
       res.render('message',{
         user : auth.getLoggedUser(req),
         page_name : '',
         message : '비밀번호가 일치하지 않습니다. 다시 시도해 주세요',
         redirect : '/addressDetail/' + auth.getLoggedUser(req).addr
      });
    }else if(result == 'emailExist'){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '이미 가입된 이메일입니다.',
        redirect : '/addressDetail/' + auth.getLoggedUser(req).addr
      });
    }else if(result == 'wrongEmail'){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '변경된 주소로 이메일을 보내지 못했습니다. 이메일 주소를 확인하시기 바랍니다.',
        redirect : '/addressDetail/' + auth.getLoggedUser(req).addr
      });
    }else if(result == 'updated1'){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : name + '님의 정보가 변경되었습니다.',
        redirect : '/addressDetail/' + auth.getLoggedUser(req).addr
      });
    }else{

    }
  });
});

module.exports = router;
