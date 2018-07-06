const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
//const logger = require('../middleware/mylogger.js');

router.get('/address',auth.isAdmin,(req,res,next)=>{

  //userInfo.find({},(err,result)=>{ // sort function added by leepg
  userInfo.find({}).sort({'addr':1}).exec((err,result)=>{
    res.render('address',{
      addr : result,
      user : auth.getLoggedUser(req),
      page_name : 'address'
    })
  });
  /*
  logger.log({
    level : 'info',
    url : '/address',
    user : req.user.email,
    message : 'GET success'
  });
  */
});

module.exports = router;
