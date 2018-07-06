const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const multichain = require('../middleware/multichain-connection');
const logger = require('../middleware/winston.js');

router.get('/permission',auth.isAdmin,(req,res)=>{
  multichain.getAddresses((err,addr)=>{
    if(err){
      throw err;
    }

    multichain.listPermissions((err,data)=>{
      if(err){
        throw err;
      }

      res.render('permission',{
        addr : addr,
        permissions : data,
        user : auth.getLoggedUser(req)
      });
    });
  });
});

module.exports = router;
