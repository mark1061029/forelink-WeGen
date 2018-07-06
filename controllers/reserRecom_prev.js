const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const reserInfo = require('../models/reservation.js');

router.get('/reserRecom/',auth.isAdmin,(req,res)=>{

  reserInfo.find({},(err,result)=>{
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
          var basicEmail = result[index].email;
          var patron = result.patron;
          reserInfo.find({ "basicEmail" : "hscho@forelink.co.kr"},(err,result2)=>{
            reserInfo.count({},(err,result3)=>{
              if(err){
                throw err;
              } else {
                let patronCount = result3;
                let reservation = {};
                reservation.name = result[index].name;
                reservation.email = basicEmail;
                reservation.phone = result[index].phone;
                reservation.patron = result[index].patron;
                reservation.patron_phone = result[index].patron_phone;
                reservation.date = result[index].date;
                reservation.patronCount = patronCount;
                ledger[index] = reservation;
              }
            })
          })
        }

        res.render('reserRecom',{
          data : ledger,
          user : auth.getLoggedUser(req),
          thisuser : 'admin',
          page_name : 'reserRecom'
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
