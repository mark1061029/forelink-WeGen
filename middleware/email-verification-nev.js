const mongoose = require('mongoose'); // <- '../mongodb/connection.js', changed by leepg for email-verification
const bcrypt = require('bcrypt');     // added by leepg
const nev = require('email-verification')(mongoose);
const User = require('../models/user.js');
const TempUser = require('../models/tempUser.js'); // added by leepg

const WeGen_conf = require('../helpers/conf.json')

const hasher = (password, tempUserData,insertTempUser,callback)=>{
  console.log('hasher activated: password = ' + password);
  console.log(tempUserData);          // added by leepg for debugging
  console.log(insertTempUser);        // added by leepg for debugging
  password = tempUserData.pwd;        // added by leepg to avoid abort 'data and salt arguments required'
  const hash = bcrypt.hashSync(password,bcrypt.genSaltSync(8),null);
  let res = insertTempUser(hash,tempUserData,callback);
  console.log('tempUser inserted');
  return res;
}

nev.configure({
  verificationURL : WeGen_conf.verificationURL,

  persistentUserModel : User,
  expirationTime : 1,       // TODO: 1 sec but not expired. issue time should be saved ???
  emailFieldName : 'email', // TODO: additional issue, tempUser in db automatically removed or not ???
  passwordFieldName : 'pwd',
  URLFieldName: 'GENERATED_VERIFYING_URL', // added by leepg

  transportOptions: {
    service: 'Gmail',
    auth: {
      user: WeGen_conf.smtpGmail,
      pass: WeGen_conf.smtpGmailPwd
    }
  },
  verifyMailOptions: {          // added by leepg
    from: 'Gmov <user@gmail.com>',
    subject: 'Confirm your account',
    html: '<p>Please verify your account by clicking <a href="${URL}">this link</a>. If you are unable to do so, copy ' +
          'and paste the following link into your browser:</p><p>${URL}</p>'+
          '<br>' +
          '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>',
    text: 'Please verify your account by clicking the following link, or by copying and pasting it into your browser: ${URL}'
  },
  shouldSendConfirmation: true, // added by leepg
  confirmMailOptions: {         // added by leepg
    from: 'Gmov <user@gmail.com>',
    subject: 'Successfully verified!',
    html: '<p>Your account has been successfully verified.</p>'+
          '<br>' +
          '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>',
    text: 'Your account has been successfully verified.'
  },


  hashingFunction : hasher,
},(err,options)=>{
  if(err){
    console.log(err);
    return;
  }
  console.log('nev configured : ' + (typeof options === 'object'));
});

// added by leepg for 2-step email verification
nev.generateTempUserModel(User, function(err, tempUserModel) {
  if (err) {
    console.log(err);
    return;
  }
  console.log('nev tempuser model generated : ' + (typeof tempUserModel === 'function'));
});
nev.configure({
  tempUserModel: TempUser
}, function(err, options){
  if(err){
    console.log(err);
    return;
  }
  console.log('nev tempuser configured : ' + (typeof options === 'object'));
});

module.exports = nev;
