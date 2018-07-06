const express = require('express');

const router = express.Router();

router.get('/unkown_url',(req,res,next)=>{
  res.render('unknow_rul',{
    user : auth.getLoggedUser(req),
    page_name : 'unkown_url'
  })
});

router.get('/server_error',(req,res,next)=>{
  res.render('server_error',{
    user : auth.getLoggedUser(req),
    page_name : 'server_error'
  })
});

module.exports = router;
