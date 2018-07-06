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
      let ledger = [];
      if(result != null){
        reserInfo.aggregate([{$group : {_id:{patron_phone:"$patron_phone"}, count:{$sum:1}, patron_name:{$last: "$patron_name"}}}],(err,result2)=>{
          console.log(result2);
          for(let index in result2){
            let reservation = {};

            reservation._id = result2[index]._id.patron_phone;
            reservation.patron_name = result2[index].patron_name;
            reservation.patronCount = result2[index].count;
            ledger[index] = reservation;
          }
          res.render('reserRecom',{
            data : ledger,
            user : auth.getLoggedUser(req),
            thisuser : 'admin',
            page_name : 'reserRecom'
          });
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
