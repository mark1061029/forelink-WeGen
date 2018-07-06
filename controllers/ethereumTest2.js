const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
const eth = require('../models/eth');
const sysInfo =require('../models/systemInfo');

router.get('/ethereumTest2',auth.isAdmin,(req,res,next)=>{
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

});
