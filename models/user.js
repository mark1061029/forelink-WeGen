const mongoose = require('mongoose');
const bcrypt = require('bcrypt-nodejs');

const userSchema = mongoose.Schema({
  name : String,
  id : String,
  pwd : String,
  addr : String,
  phone : String,
  email : String,
  ethAddr : String,  // 2018.02.21 updated 윤성규
  rxnoti : { type: Boolean, default: true  }, // added by leepg
  txnoti : { type: Boolean, default: false }, // added by leepg
  issuenoti : { type: Boolean, default: false }, // added by leepg
  pICO : {type: Boolean, default: false },    //2018.02.21 updated 윤성규
  cICO : {type: Boolean, default: false },     //2018.02.21 updated 윤성규
  otpCheck : {type : Boolean, default : false}, // 2018.03.06 updated 윤성규
  otpKey : String,  // 2018.03.06 updated 윤성규
  disabled : {type: Boolean, default : false},
});

userSchema.methods.generateHash = (password)=>{
  return bcrypt.hashSync(password,bcrypt.genSaltSync(8),null);
}

userSchema.methods.validPassword = (password,pwd) =>{
  return bcrypt.compareSync(password, pwd);
}

userSchema.methods.getRandomString = ()=>{
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 40; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

module.exports = mongoose.model('user',userSchema);
