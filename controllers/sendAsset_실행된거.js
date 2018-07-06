const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const reserInfo = require('../models/reservation.js');

router.get('/sendAsset',(req,res)=>{
  res.render('sendAsset',{
    //header.ejs (메뉴) 에 사용되는 user 정보
    //페이지 식별 정보
    page_name : 'sendAsset',
    message : '포어링크 지역화폐 시스템' // welcome message added by leepg
  });
});

router.post('/sendAsset',(req,res)=>{
  const name = req.body.name;
  const email = req.body.email;
  const phone = req.body.phone;
  const patron = req.body.patron;

  let now = new Date();

  reserInfo.count({},(err,count)=>{
    let indexNo = ++count;

    reserInfo.insertMany({
      'index' : indexNo,
      'phone' : phone,
      'name' : name,
      'email' : email,
      'patron' : patron,
      'date' : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
    },(err,result)=>{
      if(err){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : '업데이트 도중 문제가 발생하였습니다.',
            redirect : '/sendAsset'
          });
          throw err;
        }
        res.redirect('/sendAsset');
    });
  });
});

module.exports = router;
