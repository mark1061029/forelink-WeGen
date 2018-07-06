const express = require('express');
const generator = require('generate-password');
const router = express.Router();

const auth = require('../helpers/authentication');

const userInfo = require('../models/user.js');
const nodemailer = require('nodemailer'); // added by leepg
const sysInfo = require('../models/systemInfo.js');

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
var notifyViaEmail = true;

let pwdURL = WeGen_conf.controllers_findPwd_pwdURL;

router.get('/findPwd',(req,res)=>{

  sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      if(result != null){
        let info = auth.getEffectDate(result);

        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
          }else{
            if(result != null){
              //result[0] 얻고자 하는 데이터
              let deskemail = result[0].deskemail;
              res.render('findPwd',{
                user : auth.getLoggedUser(req),
                page_name : 'findPwd',
                deskemail : deskemail
              })
            }else{
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : "DB 조회중 오류가 발생하였습니다.",
                redirect : '/'
              });
            }
          }
        });
      }else{
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : "DB 조회중 오류가 발생하였습니다.",
          redirect : '/'
        });
      }
    }
  });
});



router.post('/findPwd',(req,res)=>{
  const email = req.body.email;
  const deskemail = req.body.deskemail;
  userInfo.findOne({'email' : email},(userErr,user)=>{
    if(userErr){
      throw userErr;
    }

    if(!user || user.email !== email || user.isAdmin){ // added by leepg // searching admin's passwd is impossible
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '해당 이메일로 가입된 사용자가 없습니다',
        redirect : '/login'
      });
    }else{ // added by leepg
      // reset passswd because current passwd is encrypted
      let resetPasswd = generator.generate({ length: 10, numbers: true });

      sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
        let info = auth.getEffectDate(result);
        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
          }else{
            if(result==null){

            }else{
              let deskemail = result[0].deskemail

              userInfo.update({'email' : email},{
                pwd : user.generateHash(resetPasswd)
              },(pwdErr,pwdResult)=>{
                if(pwdErr){
                  throw pwdErr;
                }
                console.log("reset passwd to " + resetPasswd);
                if(!notifyViaEmail){
                  res.render('message',{
                    user : auth.getLoggedUser(req),
                    page_name : '',
                    message : '비밀번호를 ' + resetPasswd + '로 초기화했습니다. 재로그인하세요.',
                    redirect : '/login'
                  });
                }else{
                  var mailOptions = { // todo: construct more friendly email
                    from : emailSender,
                    to : user.name + '<' + email + '>',
                    subject : '나눔코인 \'비밀번호 찾기\' 결과입니다',
                    html : '요청하신 <b>' + user.name + '</b>(' + email + ')님의 비밀번호를 \'' +
                           '<span style="color:blue"><b>' + resetPasswd + '</b></span>\'로 초기화했습니다.<br>' +
                           '<a href='+ pwdURL +'>로그인 하러 가기.</a><br>' +
                           '<br>' +
                           '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다</i><br>'+'기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                    text : '요청하신 ' + user.name + '(' + email + ')님의 비밀번호를 ' + resetPasswd + '로 초기화했습니다.\n' +
                           '나눔코인 사이트에서 재로그인하시기 바랍니다.'
                  };
                  smtpTransport.sendMail(mailOptions, function(emailErr, emailRes){
                    if(emailErr){
                      console.log(emailErr);
                      res.render('message',{
                        user : auth.getLoggedUser(req),
                        page_name : '',
                        message : '메일 시스템에 접속하지 못했습니다. 운영자에게 연락하세요.',
                        redirect : '/findPwd'
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
            }
          }
        });
      });
    }
  });
});

module.exports = router;
