const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg
const async = require('async');

const router = express.Router();
const auth = require('../helpers/authentication');
const nev = require('../middleware/email-verification-nev.js');

// signup comeback url <- forgot your password comeback url - modified by leepg
router.get('/email-verification/:URL',(req,res)=>{
  const url = req.params.URL;
  console.log('user accessd verification url: ' + url);
  if(false){
    console.log(req); // IncomingMessage { ... }
    console.log(res); // ServerResponse { ... }
  }

  async.waterfall([
    function(callback){
      nev.confirmTempUser(url,(err,user)=>{
        if(!user){
          console.log('expired url !!!');
          callback(true,"failed1");
          return;
        }else{
          let sendMailBySystem = true;
          if(!sendMailBySystem){
            callback(null,user);
          }else{
            callback(true,user);
            return;
          }
        }
      });
    },function(args,callback){
      nev.sendConfirmationEmail(args.email,(err,info)=>{
        if(err){
          console.error(err);
          callback(true,"failed2");
          return;
        }else{
          callback(null,args);
        }
      })
    }
  ],function(err,result){
    if(result == "failed1"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '유효하지 않은 링크입니다.',
        redirect : '/'
      });
    }else if(result == "failed2"){
      res.status(404).send('ERROR : sending confirmation email FAILED');
    }else{
      console.log(result.name + '(' + result.email + ') signup is completed');

      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : result.name + '님의 회원가입이 완료되었습니다.',
        redirect : '/login'
      });
    }
  });
});

module.exports = router;
