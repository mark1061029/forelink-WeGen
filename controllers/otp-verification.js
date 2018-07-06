const express = require('express');
const router = express.Router();
const passport = require('passport');
const googleOTP = require('../middleware/otp.js');

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const logger = require('../middleware/winston.js');

/*
router.get('/otp-verificaton',(req,res)=>{

  googleOTP.generate("X7KdxQGcBy6M3vKDYGE5pFAF7klwz9UjZSkEjnOT");

  let qrCode = googleOTP.qrCodeGenerate("X7KdxQGcBy6M3vKDYGE5pFAF7klwz9UjZSkEjnOT");

  res.render('otp-verification',{
    QRCODE : qrCode
  })
});
*/

router.post('/otp-verification',(req,res,next)=>{

  const userInput = req.body.otpCode;

  googleOTP.generate("X7KdxQGcBy6M3vKDYGE5pFAF7klwz9UjZSkEjnOT");

  let result2 = googleOTP.verification(userInput,"X7KdxQGcBy6M3vKDYGE5pFAF7klwz9UjZSkEjnOT");
  sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
    let info = auth.getEffectDate(result);
    sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
      if(err){
        throw err;
      }else{
        let reCaptcha = result[0].reCaptcha;
        if(result2 == null){
          res.render('login',{
            user : auth.getLoggedUser(req),
            page_name : '',
            reCaptcha : reCaptcha,
            otpCheck : null
          })
        }else{
          if(result2.delta == 0){
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
                return res.redirect('/configure');
              })
            })(req,res,next);
          }else{
            res.render('login',{
              user : auth.getLoggedUser(req),
              page_name : '',
              reCaptcha : reCaptcha,
              otpCheck : null
            });
          }
        }

      }
    });
  });

});

module.exports = router;
