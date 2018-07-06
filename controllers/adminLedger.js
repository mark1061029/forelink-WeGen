const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const accountInfo = require('../models/account.js');

router.get('/adminLedger/',auth.isAdmin,(req,res)=>{

  accountInfo.find({},(err,result)=>{
    if(err){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : err,
        redirect : '/'
      });
      throw err;
    }else{
      if(result != null){

        let ledger = [];


        for(let index in result){

          let account = {};

          account.from = result[index].from;
          account.to = result[index].to;
          account.description = result[index].description;
          account.memo = result[index].memo;
          account.date = result[index].date;

          account.balance = result[index].balance;
          account.output = result[index].output;
          account.input = result[index].input;

          ledger[index] = account;

        }

        res.render('adminLedger',{
          data : ledger,
          user : auth.getLoggedUser(req),
          thisuser : 'admin',
          page_name : 'adminLedger'
        });
      }else{
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : err,
          redirect : '/'
        });
      }
    }
  });
});

module.exports = router;
