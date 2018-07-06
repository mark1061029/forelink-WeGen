const express = require('express');
const router = express.Router();

const async = require('async');

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet')
const userInfo = require('../models/user.js');
const sysInfo = require('../models/systemInfo.js');
const logger = require('../middleware/winston.js');

router.get('/icoParticipate',auth.isLoggedIn,(req,res)=>{

  sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      if(result != null){
        let info = auth.getEffectDate(result);

        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          if(err){
            throw err;
          }else{
            if(result != null){
              let rate = result[0].rate;
              let minAccount = result[0].minAccount;
              let maxAccount = result[0].maxAccount;
              let ethAddr = result[0].ethAddr;

              userInfo.findOne({addr : req.user.addr}, (err,userRes)=>{
                res.render('icoParticipate',{
                  user : auth.getLoggedUser(req),
                  page_name : 'icoParticipate',
                  userEthAddr : userRes.ethAddr,
                  rate : rate,
                  minAccount : minAccount,
                  maxAccount : maxAccount,
                  ethAddr : ethAddr
                });
              });
            }else{
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : "DB 조회중 오류가 발생하였습니다.",
                redirect : '/'
              });
            }
          }
        });
      }else{
        res.render('message',{
          user : auth.getLoggedUser(req),
          page_name : '',
          message : "DB 조회중 오류가 발생하였습니다.",
          redirect : '/'
        });
      }
    }
  });
});

router.post('/icoParticipate',(req,res)=>{
  let ethAddr = req.body.wallet;
  let addr = req.user.addr;

  async.waterfall([
    function(callback){
      userInfo.findOne({ethAddr : ethAddr},(err,userResult)=>{
        if(err){
          throw err;
        }else{
          if(userResult == null){
            callback(null);
          }else{
            callback(true,"invalidAddr");
            return;
          }
        }
      });
    },function(callback){
      userInfo.update({addr : addr},{$set:{ethAddr : ethAddr, pICO : true}},(err,mongooseRes)=>{
        if(!err){
          console.log('Ethereum Address upsert complete');
          callback(null,"success");
        }else{
          //에러 핸들
          console.log('Controller-icoParticipate : userInfo.findOneAndUpdate failed');
          callback(true,"dbErr");
          return;
        }
      });
    }
  ],function(err,result){
    if(result == "invalidAddr"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '이미 등록되어 있는 이더리움 주소입니다.',
        redirect : '/icoParticipate'
      });
    }else if(result == "dbErr"){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : 'DB서버 문제가 발생하였습니다. 다시 시도 하여주세요.',
        redirect : '/icoParticipate'
      })
    }else{
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : '이더리움 주소가 등록되었습니다.',
        redirect : '/icoParticipate'
      });
    }
  });
});

module.exports = router;
