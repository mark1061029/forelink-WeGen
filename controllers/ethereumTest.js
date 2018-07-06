const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
const eth = require('../models/eth');
const sysInfo = require('../models/systemInfo');

router.get('/ethereumTest',auth.isAdmin,(req,res,next)=>{

  sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      if(result != null){
        let info = auth.getEffectDate(result);

        sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
          res.render('ethereumTest',{
            user : auth.getLoggedUser(req),
            page_name : 'ethereumTest',
            adminEthAddr : result[0].ethAddr
          });
        });
      }else{
        res.render('ethereumTest',{
          user : auth.getLoggedUser(req),
          page_name : 'ethereumTest',
          adminEthAddr : ''
        });
      }
    }
  });
});

router.post('/ethereumTest',auth.isAdmin,(req,res,next)=>{
  const userEthAddr = req.body.fromAddress;
  const adminEthAddr = req.body.toAddress;
  const value = req.body.amount;

  let qty = Number(value) * 10000000000 * 100000000

  sysInfo.find().sort({effectDate:-1}).exec((err,result)=>{
    let info = auth.getEffectDate(result);
    sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
      if(err){

      }else{
        if(adminEthAddr == result[0].ethAddr){
          eth.count({},(err,count)=>{
            let transaction = {
              blockNumber : count,
              from : userEthAddr,
              to : adminEthAddr,
              txHash : count,
              value : qty,
              timestamp : "",
              complete : false
            }

            eth.insertMany(transaction,(err,result)=>{
              res.render('message',{
                user : auth.getLoggedUser(req),
                page_name : '',
                message : "이더리움 입금 가상 데이터가 입력되었습니다.",
                redirect : '/ethereumTest'
              });
            })
          });
        } else {
          res.render('ethereumTest',{
            user : auth.getLoggedUser(req),
            page_name : 'ethereumTest',
            adminEthAddr : ''
          });
        }
      }
    })
  })

});

module.exports = router;
