const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const logger = require('../middleware/winston.js');

router.get('/privacyPolicy',(req,res)=>{
  res.render('privacyPolicy',{
    //header.ejs (메뉴) 에 사용되는 user 정보
    user : auth.getLoggedUser(req),
    //페이지 식별 정보
    page_name : 'termsAndConditions',
    message : '포어링크 지역화폐 시스템' // welcome message added by leepg
  })
})

module.exports = router;
