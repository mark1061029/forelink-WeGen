const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const smsInfo = require('../models/SMS.js');

router.get('/reserSMS/',auth.isAdmin,(req,res)=>{
  smsInfo.find({},(err,result)=>{
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
          let SendMsg = {};
          SendMsg.phone = result[index].phoneNo;
          SendMsg.checkNumber = result[index].checkNumber;
          SendMsg.date = result[index].date;
          ledger[index] = SendMsg;
        }
        res.render('reserSMS',{
          data : ledger,
          user : auth.getLoggedUser(req),
          thisuser : 'admin',
          page_name : 'reserSMS'
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
