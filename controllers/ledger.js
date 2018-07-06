const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const accountInfo = require('../models/account.js');
const user = require('../models/user.js');
const logger = require('../middleware/winston.js');

router.get('/ledger/:addrTag',auth.isLoggedIn,(req,res)=>{

  let addr = req.user.addr;

  if(req.user.isAdmin){
    addr = req.params.addrTag;
  }

  user.findOne({'addr':addr},(err,userInfo)=>{
    if(err){
      throw err;
    }else{
      if(userInfo != null){
        accountInfo.find({'from':userInfo.email},(err,result)=>{
          if(err){
            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : err
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

              res.render('ledger',{
                data : ledger,
                user : auth.getLoggedUser(req),
                thisuser : userInfo.email,
                page_name : 'ledger'
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
      }
    }
  });
});

module.exports = router;
