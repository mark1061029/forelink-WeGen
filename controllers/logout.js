const express = require('express');
const router = express.Router();
const logger = require('../middleware/winston.js');

router.get('/logout', (req,res)=>{
  console.log("logout");
  req.logout();
  res.redirect('/login');
});

module.exports = router;
