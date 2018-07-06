const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const accountInfo = require('../models/account.js');
const logger = require('../middleware/winston.js');

router.get('/sendDetail',auth.isLoggedIn,(req,res)=>{
  let id = req.user.id;

  if(req.query.id){
    id = req.query.id
  }

  accountInfo.find({'from' : id}).sort({'date':-1}).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      res.render('sendDetail',{
        data : result,
        user : auth.getLoggedUser(req),
        thisuser : id,
        page_name : 'sendDetail'
      });
    }
  });
});

router.get('/sendDetail/:addrTag',auth.isAdmin,(req,res)=>{

  const addrTag = req.params.addrTag;

  accountInfo.find({'id' : addrTag}).sort({'date':-1}).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      res.render('sendDetail',{
        data : result,
        user : auth.getLoggedUser(req)
      });
    }
  });
});

module.exports = router;
