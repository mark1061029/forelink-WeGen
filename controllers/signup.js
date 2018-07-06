const express = require('express');
const router = express.Router();
const passport = require('passport');

const auth = require('../helpers/authentication');
const userInfo = require('../models/user.js');
const logger = require('../middleware/winston.js');

router.get('/signup',(req,res)=>{
  var iserror = req.flash('error'); // added by leepg for login error message
  if(iserror.length > 0){           //
    console.log(iserror[0]);
    res.render('message',{
      user : auth.getLoggedUser(req),
      page_name : '',
      message : iserror[0],
      redirect : '/'
    });
  }else{
    res.render('signup',{
      user : auth.getLoggedUser(req),
      page_name : 'signup'
    });
  }
});

router.post('/signup',passport.authenticate('signup',{
  successRedirect : '/', // changed by leepg // <- '/login'
  failureRedirect : '/signup',
  failureFlash : true // added by leepg for signup error message
}));

module.exports = router;
