const express = require('express');
const router = express.Router();

const multichain = require('../middleware/multichain-connection');

const auth = require('../helpers/authentication');

router.get('/getinfo',auth.isAdmin,(req,res,next)=>{
  //userInfo.find({},(err,result)=>{ // sort function added by leepg
  multichain.getInfo((err,info)=>{
    if(err){
      throw err;
    }else{
      res.render('getinfo',{
        user : auth.getLoggedUser(req),
        page_name : 'address',
        infos : info,
      })
    }
  });
});

module.exports = router;
