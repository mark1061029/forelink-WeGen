const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const reserInfo = require('../models/reservation.js');
const sysInfo = require('../models/systemInfo.js');

router.get('/reserReport/',auth.isAdmin,(req,res)=>{
  reserInfo.find({},(err,result)=>{
    sysInfo.find().sort({effectDate:-1}).exec((err,sysResult)=>{
      let info = auth.getEffectDate(sysResult);
      sysInfo.find({effectDate : info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result2)=>{
        if(err){
          res.render('message',{
            user : auth.getLoggedUser(req),
            page_name : '',
            message : err,
            redirect : '/'
          });
          throw err;
        } else {
          if (result != null) {
            let ledger = [];

            for (let index in result) {
              let reservation = {};
              // if (result2 != null) {
              //   console.log("result2[0].location1 : " + result2[0].location);
              //   reservation.location = result2[0].location;
              // }
              console.log("result["+index+"].location : " + result[index].location);
              // reservation.email = result[index].email;
              // reservation.patron = result[index].patron;
              reservation.name = result[index].name;
              reservation.phone = result[index].phone;
              reservation.patron_phone = result[index].patron_phone;
              reservation.date = result[index].date;
              reservation.location = result[index].location;
              ledger[index] = reservation;
            }
            res.render('reserReport',{
              data : ledger,
              user : auth.getLoggedUser(req),
              thisuser : 'admin',
              page_name : 'reserReport'
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
  });
});

module.exports = router;
