const express = require('express');
const passport = require('passport');

const router = express.Router();

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
const sysInfo = require('../models/systemInfo.js');

const googleOTP = require('../middleware/otp.js');

const WeGen_conf = require('../helpers/conf.json');
const logger = require('../middleware/winston.js');

router.get('/login', (req,res)=>{
  sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
    let info = auth.getEffectDate(result);
    sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
      if(err){
        throw err;
      }else{
        sess = req.session;
        sess.testMode = result[0].testMode;
        console.log(req.session.testMode);
        let reCaptcha = result[0].reCaptcha;
        var iserror = req.flash('error'); // added by leepg for login error message
        if(iserror.length > 0 && iserror[0] !== 'Missing credentials'){           //
          console.log(iserror[0]);
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : iserror[0],
            redirect : '/login'
          });
        }else{
          console.log("로그인화면 에서 result[0].reCaptcha값 : " + result[0].reCaptcha);
          res.render('login',{
            user : auth.getLoggedUser(req),
            page_name : 'login',
            otpCheck : null,
            reCaptcha : reCaptcha
          });
          console.log("로그인화면 에서 reCaptcha값 : " + reCaptcha);
        }

      }
    });
  });

});

router.post('/login',(req,res,next)=>{
  let userEmail = req.body.email;
  let userPwd = req.body.pwd;

  let qrCode = googleOTP.qrCodeGenerate(WeGen_conf.otpcode);

  //test Code
  let currentCode = googleOTP.generate(WeGen_conf.otpcode);

  userInfo.findOne({'email' : userEmail},(err,result)=>{

    console.log(result);
    if(err){
      throw err;
    }else{
      if((result != null) && (result.disabled == false)){
        if(!result.validPassword(userPwd,result.pwd)){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '잘못된 암호입니다.',
            redirect : '/login'
          });
        }else{
          if(result.otpCheck){
            res.render('login',{
              user : auth.getLoggedUser(req),
              page_name : 'login',
              otpCheck : true,
              userEmail : userEmail,
              userPwd : userPwd,
              qrCode : qrCode,
              currentCode : currentCode
            });
          }else{
            passport.authenticate('login',(err,user,info)=>{
              if(err){
                return next(err);
              }
              if(!user){
                return res.redirect('/login');
              }
              req.logIn(user,function(err){
                if(err){
                  return next(err);
                }
                return res.redirect('/myWallet/userEmail');
              })
            })(req,res,next);
          }
        }
      }else{
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '존재하지 않는 아이디 입니다.',
          redirect : '/login'
        });
      }
    }
  });
});

/*
router.post('/login', passport.authenticate('login',{
  successRedirect : '/',
  failureRedirect : '/login',
  failureFlash : true // added by leepg for login error message
}));
*/
module.exports = router;
