const express = require('express');

const router = express.Router();

const auth = require('../helpers/authentication');
const logger = require('../middleware/winston.js');

router.get('/404',(req,res,next)=>{
  next();
});

router.use((req,res,next)=>{
  res.status(404);

  res.render('PageNotFound',{
    user : auth.getLoggedUser(req),
    page_name : '404'
  });
});

module.exports = router;
