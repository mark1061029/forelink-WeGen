const express = require('express');
const router = express.Router();

const auth = require('../helpers/authentication');

const multichain = require('../middleware/multichain-connection');
const userInfo = require('../models/user.js');
const logger = require('../middleware/winston.js');

router.get('/permissions/:addrTag',auth.isAdmin,(req,res)=>{
  let addrTag = req.user.addr;

  if(req.user.isAdmin){
    addrTag = req.params.addrTag;
  }

  userInfo.findOne({'addr' : addrTag},(err,result)=>{
    if(err){
      throw err;
    }

    const addr = result.addr;

    multichain.listPermissions({addresses : addr},(err,data)=>{
      if(err){
        throw err;
      }

      let permissions = new Object();

      for(let index in data){
        for(let key in data[index]){
          if(key == 'type'){
              permissions[index] = data[index][key];
          }
        }
      }

      res.render('permissions',{
        email : result.email,
        addr : addr,
        permissions : permissions,
        user : auth.getLoggedUser(req),
        page_name : 'permissions'
      })
    });
  });
});

router.post('/permissions/:addrTag',(req,res)=>{
  const addr = req.body.hiddenAddr;

  let permissions = [ 'mine', 'admin', 'activate', 'connect', 'send', 'receive', 'issue', 'create']
  let grantsperms = ""; // 'mine'/'admin'/activate' could not granted, always true 'create' by leepg
  let revokeperms = ""; // added by leepg for revoke permissions that is checked

  for (i = 0; i < permissions.length; i++) {
    if(typeof(req.body[permissions[i]]) != 'undefined' || permissions[i] == 'create'){
      grantsperms += permissions[i]+',';
    }else{
      revokeperms += permissions[i]+',';
    }
  }

  grantsperms = grantsperms.substring(0, grantsperms.length-1); // remove ending ','
  revokeperms = revokeperms.substring(0, revokeperms.length-1); // remove ending ','
  //console.log(grantsperms); console.log(revokeperms);

  multichain.grant({
    addresses : addr,
    permissions: grantsperms},
    (err,data)=>{
      if(err){
        console.log(err);
        throw err;
      }
      multichain.revoke({ // added by leepg to revoke permission
        addresses : addr,
        permissions: revokeperms},
        (err,data)=>{
          if(err){
            console.log(err);
            throw err;
          }
          res.render('message',{ // changed by leepg because of abort // <- res.redirect('message', ...
          user : auth.getLoggedUser(req),
          page_name : '',
          message : '권한이 정상적으로 수정되었습니다.',
          redirect : '/permissions/' + auth.getLoggedUser(req).addr
          }
        );
      });
    }
  );
});

module.exports = router;
