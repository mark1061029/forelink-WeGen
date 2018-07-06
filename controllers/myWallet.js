const express = require('express');
const router = express.Router();

const multichain = require('../middleware/multichain-connection');

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet.js')
const userInfo = require('../models/user.js');
const logger = require('../middleware/winston.js');

router.get('/myWallet/:addrTag',auth.isLoggedIn,(req,res,next)=>{
  //userInfo.find({},(err,result)=>{ // sort function added by leepg

  userInfo.findOne({'addr' : req.user.addr},(err,userResult)=>{
    if(err){

      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '지갑 조회중 오류가 발생하였습니다. 다시 시도 하여주십시오.',
        redirect : '/'
      });

      throw err;
    }else{
      if(userResult == null){
        res.render('myWallet',{
          user : auth.getLoggedUser(req),
          page_name : 'myWallet',
          multiAddr : '',
          balance : ''
        });
      }else{
        multichain.getAddressBalances({address : userResult.addr},(err,asset)=>{
          if(err){

            res.render('message',{
              user : auth.getLoggedUser(req),
              page_name : '',
              message : '지갑 조회중 오류가 발생하였습니다. 다시 시도 하여주십시오.',
              redirect : '/'
            });

            throw err;
          }
          let qty = wallet.getAddressBalances(asset);

          res.render('myWallet',{
            user : auth.getLoggedUser(req),
            page_name : 'myWallet',
            multiAddr : userResult.addr,
            balance : qty
          });
        });
      }
    }
  });
});

module.exports = router;
