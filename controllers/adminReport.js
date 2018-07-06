const express = require('express');
const router = express.Router();

const async = require('async');

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
const eth = require('../models/eth.js');

const logger = require('../middleware/winston.js');

router.get('/adminReport',auth.isAdmin,(req,res,next)=>{
  //eth 디비
  //users 디비
  //multichain

  async.waterfall([
    function(callback){

    }

  ],function(err,result){

  });
});

module.exports = router;
