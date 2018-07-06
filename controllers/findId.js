const express = require('express');
const nodemailer = require('nodemailer'); // added by leepg

const router = express.Router();

const auth = require('../helpers/authentication');

const userInfo = require('../models/user.js');

const WeGen_conf = require('../helpers/conf.json');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: WeGen_conf.smtpGmail,
      pass: WeGen_conf.smtpGmailPwd
    }
});
var emailSender = WeGen_conf.emailSender;
var noreplyTail = '<i><small>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</small></i>';
var notifyViaEmail = true;

router.get('/findId',(req,res)=>{
  res.render('findId',{
    user : auth.getLoggedUser(req),
    page_name : 'findId'
  });
})

router.post('/findId',(req,res)=>{ // implemented by leepg
  const name = req.body.name;
  const email = req.body.email;

  userInfo.find({'email' : email},(emailErr,emailUsers)=>{
    if(emailErr){
      throw emailErr;
    }
    let matchCount = 0;
    let foundId = "";
    if(emailUsers){
      for (let i = 0; i < emailUsers.length; i++){
        if(emailUsers[i].name === name && emailUsers[i].id !== "admin"){ // searching admin's id is impossible
          console.log(email + " is used for " + emailUsers[i].name);
          matchCount++;
          if(foundId === ""){
            foundId = emailUsers[i].id;
          }
        }
      }
    }
    if(matchCount < 1){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '일치하는 가입자가 없습니다.',
        redirect : '/findId'
      });
    }else if(matchCount > 1){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '일치하는 가입자가 두명 이상입니다. 관리자에게 문의하세요.',
        redirect : '/findId'
      });
    }else if(!notifyViaEmail){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '요청하신 ' + req.body.name + ' 아이디는 ' + foundId + ' 입니다.',
        redirect : '/login'
      });
    }else{
      console.log("found = " + foundId + "(" + name + ") with " + email);
      var mailOptions = { // todo: construct more friendly email
        from : emailSender,
        to : name + '<' + email + '>',
        subject : '나눔코인 \'아이디 찾기\' 결과입니다',
        html : '요청하신 <b>' + req.body.name + '</b>님의 아이디는 \'' +
               '<span style="color:blue"><b>' + foundId + '</b></span>\'입니다.<br>' +
               '<br>' +
               '<i><small>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</small></i>',
        text : '요청하신 ' + req.body.name + '님의 아이디는 ' + foundId + ' 입니다.'
      };
      smtpTransport.sendMail(mailOptions, function(emailErr, emailRes){
        if(emailErr){
          console.log(emailErr);
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '메일 시스템에 접속하지 못했습니다. 운영자에게 연락하세요.',
            redirect : '/findId'
          });
          return res.status(404).send('ERROR : sending verification email FAILED');
        }
        console.log("Message sent : " + emailRes.message);
        //smtpTransport.close();
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : email + '로 메일이 발송되었습니다. 확인해 주세요.',
          redirect : '/login'
        });
      });
    }
  });
});

module.exports = router;
