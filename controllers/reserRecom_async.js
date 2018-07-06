const express = require('express');
const router = express.Router();

const async = require('async');

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const reserInfo = require('../models/reservation.js');

router.get('/reserRecom/',auth.isAdmin,(req,res)=>{
  reserInfo.aggregate([{$group : {_id:{patron_phone:"$patron_phone"}, count:{$sum:1}, name:{$last: "$name"}}}],(err,result2)=>{
    let ledger = [];
    async.waterfall([
      function(callback){
        for(let index in result2){
          let reservation = {};
          // reserInfo.find({phone : result2[index]._id.patron_phone}, {_id:0 , name : 1, phone : 1}, (err,result3)=>{
          //   let reservation2 = {};
          //   console.log(result3);
          //   console.log(result3[0].name);
          //   result2[index].name = result3[0].name;
          //   console.log("result2[" + index + "].name : " + result2[index].name)
          // });
          console.log("result2["+ index + "].name : " + result2[index].name);
          reservation.patron_phone = result2[index]._id.patron_phone;
          reservation.name = result2[index].name;
          reservation.patronCount = result2[index].count;
          ledger[index] = reservation;

          reserInfo.find({phone : result2[index]._id.patron_phone}, {_id:0 , name : 1, phone : 1}, (err,result3)=>{
            let reservation2 = {};
            console.log(result3);
            console.log(result3[0].name);
            ledger[index].name = result3[0].name;
            console.log("result2[" + index + "].name : " + ledger[index].name);
          });
          // callback(ledger);
        }
        return;
      }
    ],function(err,ledger){
        console.log("res.render 전");
        console.log("ledger : " + ledger);
        res.render('reserRecom',{
          data : ledger,
          user : auth.getLoggedUser(req),
          thisuser : 'admin',
          page_name : 'reserRecom'
        });
    });
  });
});

module.exports = router;
