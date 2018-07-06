const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const wallet = require('../helpers/wallet');
const reserInfo = require('../models/reservation.js');

router.get('/reserTotal/',auth.isAdmin,(req,res)=>{
  let totalReser = 0;
  let totalPatron = 0;
  let count2;
  reserInfo.find({},(err,result)=>{
    if(err){
      res.render('message',{
        user : auth.getLoggedUser(req),
        page_name : '',
        message : err,
        totalReser : '',
        totalPatron : '',
        redirect : '/'
      });
      throw err;
    } else {
      reserInfo.count({},function(err,count){
        reserInfo.aggregate({$group : {_id:"$patron_phone", count:{$sum:1}}},(err,result2)=>{
          for(let index in result2){
            count2 = index;
          }
          totalReser = count;
          if (count2 == null) {
            totalPatron = 0;
          } else {
            totalPatron = count2;
          }
          if (count != null) {
            res.render('reserTotal',{
              user : auth.getLoggedUser(req),
              thisuser : 'admin',
              page_name : 'reserTotal',
              totalReser : totalReser,
              totalPatron : totalPatron
            });
          }
        });
      });
    }
  });
});

module.exports = router;
