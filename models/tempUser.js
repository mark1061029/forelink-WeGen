// added by leepg for email-verification
const mongoose = require('mongoose');
const bcrypt = require('bcrypt-nodejs');

const tempUserSchema = mongoose.Schema({
  name : String,
  id : String,
  email : String,
  pwd : String,
  addr : String,
  phone : String,
  rxnoti : { type: Boolean, default: true  }, // added by leepg
  txnoti : { type: Boolean, default: false }, // added by leepg
  issuenoti : { type: Boolean, default: false }, // added by leepg
  pICO : {type: Boolean, default: false },    //2018.03.06 updated 윤성규
  cICO : {type: Boolean, default: false },     //2018.03.06 updated 윤성규
  otpCheck : {type : Boolean, default : false}, // 2018.03.06 updated 윤성규
  otpKey : String,  // 2018.03.06 updated 윤성규
  disabled : {type: Boolean, default : false},
  createdAt : { type: Date, required: true, default: Date.now, expires: 300/*sec*/ }, // expires after 5min
  GENERATED_VERIFYING_URL : String
});

tempUserSchema.methods.generateHash = (password)=>{
  return bcrypt.hashSync(password,bcrypt.genSaltSync(8),null);
}

tempUserSchema.methods.validPassword = (password,pwd) =>{
  return bcrypt.compareSync(password, pwd);
}

module.exports = mongoose.model('tempUser',tempUserSchema);
