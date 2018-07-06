const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const icoLedger = require('../models/ico');

router.get('/icoLedger',auth.isAdmin,(req,res,next)=>{

  icoLedger.find({},(err,result)=>{
    if(err){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : err,
        redirect : '/'
      });
    }else{
      if(result == null){
        res.render('icoLedger',{
          user : auth.getLoggedUser(req),
          page_name : '',
          result : '',
          thisuser : '',
        });
      }else{
        res.render('icoLedger',{
          user : auth.getLoggedUser(req),
          page_name : '',
          result : result,
          thisuser : req.user.name
        });
      }
    }
  });
});

module.exports = router;
