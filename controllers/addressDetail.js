const express = require('express');
const router  = express.Router();

const async = require('async');

const multichain = require('../middleware/multichain-connection');

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const userInfo = require('../models/user.js');

router.get('/addressDetail/:addrTag',auth.isLoggedIn,(req,res)=>{
  let addr = req.user.addr;

  if(req.user.isAdmin == true){
    addr = req.params.addrTag;
  }
  console.log("auth.getLoggedUser(req) :"+auth.getLoggedUser(req));
  console.log("req.user"+req.user);
  async.waterfall([
    function(callback){
      userInfo.findOne({'addr' : addr},(err,userResult)=>{
        if(err){
          callback(true,"mongodb_err");
          return;
        }else{
          if(userResult == null){
            callback(true,"mongodb_null");
            return;
          }else{
            callback(null,userResult);
            return;
          }
        }
      });
    },
    function(cursor,callback){
      multichain.getAddressBalances({
        address : cursor.addr
      },(err,asset)=>{
        if(err){
          console.log(err);
          throw err;
        }
        let qty;

        if(wallet.isEmpty(asset)){
          qty = 0;
        }else{
          qty = wallet.getAddressBalances(asset);
        }

        let result = [];

        result.name       = cursor.name;
        result.qty        = qty;
        result.user       = auth.getLoggedUser(req);
        result.phone      = cursor.phone;
        result.email      = cursor.email;
        result.rxnoti     = cursor.rxnoti;
        result.txnoti     = cursor.txnoti;
        result.issuenoti  = cursor.issuenoti;
        result.ethAddr    = cursor.ethAddr;
        result.multiAddr  = cursor.addr;

        callback(null, result);
      });
    }
  ],function(err,result){
    if(result == "mongodb_err"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "MongoDB 에러가 발생하였습니다.",
        redirect : '/'
      });
    }else if(result == "mongodb_null"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : "사용자 조회 결과가 없습니다.",
        redirect : '/'
      });
    }else{
      res.render('addressDetail',{
        email : result.email,
        name : result.name,
        qty : result.qty,
        user : auth.getLoggedUser(req),
        phone : result.phone,
        rxnoti : result.rxnoti,
        txnoti : result.txnoti,
        issuenoti : result.issuenoti,
        ethAddr : result.ethAddr,
        multiAddr : result.multiAddr,
        isAdmin : result.isAdmin,
        page_name : 'addressDetail'
      });
    }
  });
});

module.exports = router;
