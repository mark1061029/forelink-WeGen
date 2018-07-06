const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const reserInfo = require('../models/reservation.js');

router.get('/reserDays/',auth.isAdmin,(req,res)=>{

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
        reserInfo.aggregate({$group : {_id:"$dateDay", count:{$sum:1}}},(err,result2)=>{
          if(err){
            throw err;
          } else{
          console.log(result2);

          for(let index in result2){
            let reservation = {};
            console.log("result2 [" + index + "]._id : " + result2[index]._id);
            console.log("result2 [" + index + "].count : " + result2[index].count);
            reservation._id = result2[index]._id;
            reservation.dateCount = result2[index].count;

            ledger[index] = reservation;

          }
      
          res.render('reserDays',{
            data : ledger,
            user : auth.getLoggedUser(req),
            thisuser : 'admin',
            page_name : 'reserDays'
          });
        }
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
