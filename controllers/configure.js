const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');

router.get('/configure',auth.isAdmin,(req,res)=>{

  sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
    let info = auth.getEffectDate(sysResult);

    if(err){
      throw err;
    }else{
      if(sysResult == null){
        res.render('configure',{
          //header.ejs (메뉴) 에 사용되는 user 정보
          user : auth.getLoggedUser(req),
          //페이지 식별 정보
          page_name : 'configure',
          icoType : '',
          ethAddr : '',
          email : '',
          apiKey : '',
          rate : '',
          startTime : '',
          endTime : '',
          icoCount : '',
          location : '',
          minAccount : '',
          maxAccount : '',
          deskemail : '',
          SMSSend : false,
          reCaptcha : false,
          testMode : false
        });
      }else{
        sysInfo.find({effectDate : info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
          }else{
            if(result == null){
              res.render('configure',{
                //header.ejs (메뉴) 에 사용되는 user 정보
                user : auth.getLoggedUser(req),
                //페이지 식별 정보
                page_name : 'configure',
                icoType : '',
                ethAddr : '',
                email : '',
                apiKey : '',
                rate : '',
                startTime : '',
                endTime : '',
                icoCount : '',
                location : '',
                minAccount : '',
                maxAccount : '',
                deskemail : '',
                SMSSend : false,
                reCaptcha : false,
                testMode : false
              });
            }else{
              //landing Page
              let startTime = result[0].startTime;
              let endTime = result[0].endTime;
              let icoCount = result[0].icoCount;

              //ico Setting
              let apikey = result[0].apiKey;
              let ethAddr = result[0].ethAddr;
              let icoType = result[0].icoType;
              let rate = result[0].rate;
              let location = result[0].location;
              let minAccount = result[0].minAccount;
              let maxAccount = result[0].maxAccount;
              let testMode = result[0].testMode;
              let effectDate = result[0].effectDate;
              //Admin Setting
              let SMSSend = result[0].SMSSend;
              let admin_email = result[0].admin_email;
              let deskemail = result[0].deskemail;
              let reCaptcha = result[0].reCaptcha;

              let sess = req.session;
              sess.testMode = result[0].testMode;

              res.render('configure',{
                user : auth.getLoggedUser(req),
                page_name : 'configure',
                icoType : icoType,
                ethAddr : ethAddr,
                email : admin_email,
                apiKey : apikey,
                startTime : startTime,
                endTime : endTime,
                rate : rate,
                icoCount : icoCount,
                location : location,
                minAccount : minAccount,
                maxAccount : maxAccount,
                SMSSend : SMSSend,
                reCaptcha : reCaptcha,
                testMode : testMode,
                deskemail : deskemail,
                effectDate : effectDate
              });
            }
          }
        })
      }
    }
  });
})

router.post('/configure',(req,res)=>{

  //landing Page
  const startTime = req.body.startTime;
  const endTime = req.body.endTime;
  const icoCount = req.body.icoCount;
  //ico setting
  const icoType = req.body.icoType;
  const apiKey = req.body.apiKey;
  const ethAddr = req.body.ethAddr;
  const rate = req.body.rate;
  const location = req.body.location;
  const minAccount = req.body.minAccount;
  const maxAccount = req.body.maxAccount;
  const effectDate = req.body.effectDate;

  //Admin setting
  const admin_email = req.body.email;
  const deskemail = req.body.deskemail;
  const testMode = req.body.testMode;
  const SMSSend = req.body.SMSSend ? true : false;
  const reCaptcha = req.body.reCaptcha ? true : false;

  let now = new Date();

  sysInfo.count({},(err,count)=>{
    let indexNo = ++count;

    sysInfo.insertMany({
      'index' : indexNo,
      'startTime' : startTime,
      'endTime' : endTime,
      'icoCount' : icoCount,
      'icoType':icoType,
      'apiKey':apiKey,
      'ethAddr':ethAddr,
      'rate':rate,
      'location' : location,
      'minAccount' : minAccount,
      'maxAccount' : maxAccount,
      'admin_email': admin_email,
      'deskemail' : deskemail,
      'updateTime' : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
      'testMode' : testMode,
      'SMSSend' : SMSSend,
      'reCaptcha' : reCaptcha,
      'effectDate' : effectDate
    },(err,result)=>{
        if(err){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '업데이트 도중 문제가 발생하였습니다.',
            redirect : '/configure'
          });
          throw err;
        }
        res.redirect('/configure');
    });
  });
});

module.exports = router;
