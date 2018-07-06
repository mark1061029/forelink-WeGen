const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const logger = require('../middleware/winston.js');

router.get('/',(req,res)=>{

  sysInfo.count({},(err,count)=>{
    sysInfo.findOne({index : count},(err,result)=>{
      if(err){
        throw err;
      }else{
        if(result != null){
          userInfo.count({},function(err,Joincount){
              if(err){
                throw err;
              }else{

                let participant = Joincount;
                res.render('index',{
                  user : auth.getLoggedUser(req),
                  page_name : 'index',
                  message : '포어링크 지역화폐 시스템',
                  startTime : result.startTime,
                  endTime : result.endTime,
                  icoCount : result.icoCount,
                  participant : participant

                });
              }
          });
        }else{
          res.render('index',{
            user : auth.getLoggedUser(req),
            page_name : 'index',
            message : '포어링크 지역화폐 시스템',
            startTime : '',
            endTime : '',
            icoCount : '',
            participant : ''
          });
        }
      }

    });
  });
})

module.exports = router;
