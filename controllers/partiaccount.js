const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const ethInfo = require('../models/eth.js');

router.get('/',(req,res)=>{

  // ethInfo.count({},(err,count)=>{
  //   let sum = 0;
  //
  //   for(i=0; i <= (count-1); i++){
  //     ethInfo.find({blockNumber : i},(err,result)=>{
  //       if(err){
  //         throw err;
  //       }else{
  //         if(result != null){
  //           sum = sum + (value/1000000000000000000);
  //           icoCount = sum;
  //         }
  //       }
  //     });
  //   }
  // });

  sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
    let info = auth.getEffectDate(result);
    sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
      if(err){
        throw err;
      }else{
        if(result == null){
          res.render('index',{
            //header.ejs (메뉴) 에 사용되는 user 정보
            user : auth.getLoggedUser(req),
            //페이지 식별 정보
            page_name : 'index',
            message : '포어링크 지역화폐 시스템', // welcome message added by leepg
            startTime : '',
            endTime : '',
            icoComplete : '',
            icoCount : '',
            icoValue : '',
            participant : '',
            ICOparti : '',
            progressbar : 0
          });
        }else{
          ethInfo.count({},function(err,ICOcount){
            userInfo.count({},function(err,Joincount){
              userInfo.count({cICO : true},(err,icoComplete)=>{

                let sum = 0;

                for(i=0; i<=(ICOcount-1); i++){
                  ethInfo.find({blockNumber : i},(err,result)=>{
                    if(err){
                      throw err;
                    }else{
                      if(result != null){
                        sum = sum + (value/1000000000000000000);
                      }
                    }
                  });
                }


                if(err){
                  throw err;
                }else{
                  let progressbar = 0;
                  let participant = Joincount;        //회원수
                  let ICOparti = ICOcount;
                  if(icoComplete == null){
                    res.render('index',{
                      //header.ejs (메뉴) 에 사용되는 user 정보
                      user : auth.getLoggedUser(req),
                      //페이지 식별 정보
                      page_name : 'index',
                      message : '포어링크 지역화폐 시스템', // welcome message added by leepg
                      startTime : '',
                      endTime : '',
                      icoComplete : '',
                      icoCount : sum,
                      icoValue : '',
                      participant : participant,
                      ICOparti : ICOparti,
                      progressbar : progressbar
                    });
                  }else{
                    if(icoComplete != 0){
                      progressbar = result[0].icoCount / icoComplete;
                    }
                    res.render('index',{
                      //header.ejs (메뉴) 에 사용되는 user 정보
                      user : auth.getLoggedUser(req),
                      //페이지 식별 정보
                      page_name : 'index',
                      message : '포어링크 지역화폐 시스템', // welcome message added by leepg
                      startTime : result[0].startTime,
                      endTime : result[0].endTime,
                      icoComplete : icoComplete,            //ico참여자 수
                      icoCount : sum,        //ico 참여금액 합한 수
                      icoValue : '0', //ico 참가금액 추가해야할 부분
                      participant : participant,
                      ICOparti : ICOparti,
                      progressbar : progressbar
                    });
                  }
                }
              });
            });
          });
        }
      }
    });
  });
})




module.exports = router;
