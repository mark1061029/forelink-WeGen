const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const sysInfo = require('../models/systemInfo.js');
const userInfo = require('../models/user.js');
const ethInfo = require('../models/eth.js');

router.get('/ico',(req,res)=>{
  // res.render('message',{
  //   user : auth.getLoggedUser(req),
  //   //페이지 식별 정보
  //   page_name : 'index',
  //   message : 'WeGen 사전예약에 오신 것을 환영합니다.', // welcome message added by leepg
  //   redirect : "/reserva"
  // });

  sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
    let info = auth.getEffectDate(result);
    sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
      if(err){
        throw err;
      }else{
        if(result == null){
          res.render('ico',{
            //header.ejs (메뉴) 에 사용되는 user 정보
            user : auth.getLoggedUser(req),
            //페이지 식별 정보
            page_name : 'ico',
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
                if(err){
                  throw err;
                }else{
                  let progressbar = 0;
                  let participant = Joincount;        //회원수
                  let ICOparti = ICOcount;
                  if(icoComplete == null){
                    res.render('ico',{
                      //header.ejs (메뉴) 에 사용되는 user 정보
                      user : auth.getLoggedUser(req),
                      //페이지 식별 정보
                      page_name : 'ico',
                      message : '포어링크 지역화폐 시스템', // welcome message added by leepg
                      startTime : '',
                      endTime : '',
                      icoComplete : '',
                      icoCount : '',
                      icoValue : '',
                      participant : participant,
                      ICOparti : ICOparti,
                      progressbar : progressbar
                    });
                  }else{
                    if(icoComplete != 0){
                      progressbar = result[0].icoCount / icoComplete;
                    }
                    res.render('ico',{
                      //header.ejs (메뉴) 에 사용되는 user 정보
                      user : auth.getLoggedUser(req),
                      //페이지 식별 정보
                      page_name : 'ico',
                      message : '포어링크 지역화폐 시스템', // welcome message added by leepg
                      startTime : result[0].startTime,
                      endTime : result[0].endTime,
                      icoComplete : icoComplete,            //ico참여자 수
                      icoCount : result[0].icoCount,
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
