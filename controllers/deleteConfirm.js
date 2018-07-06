const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

// added by leepg for user unsubscribe - begin
router.get('/deleteConfirm/:addrTag',auth.isLoggedIn,(req,res)=>{
  //console.log(req.query.id);

  let addr = req.user.addr;

  if(req.user.isAdmin){
    addr = req.params.addrTag;
  }

  res.render('deleteConfirm',{
    user : auth.getLoggedUser(req),
    userAddr : addr,
    page_name : 'deleteConfirm'
  })
});

module.exports = router;
