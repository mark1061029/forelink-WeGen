const mongoose = require('mongoose');

const systemInfo = mongoose.Schema({
  index : Number,
  icoType : String,
  txCount : Number,
  apiKey : String,
  admin_email : String,
  startTime : String,
  endTime : String,
  ethAddr : String,
  rate : Number,
  icoCount : Number,
  location : String,
  SMSSend : {type: Boolean, default : false},
  minAccount : {type: Number, default: '0.2' },
  maxAccount : {type: Number, default: '5000' },
  deskemail : {type: String, default: 'helpdesk_gmov@gmail.com'},
  reCaptcha : {type : Boolean, default : false},
  latestBlock : Number,
  updateTime : String,
  testMode : {type : Boolean, default : false},
  effectDate : String
});

module.exports = mongoose.model('systemInfo',systemInfo);


//systeminfo 조회 기본 폼
/*
sysInfo.find({}).sort({effectDate:-1}).exec((err,result)=>{
  let info = auth.getEffectDate(result);
  sysInfo.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,result)=>{
    if(err){
      throw err;
    }else{
      if(result==null){

      }else{

      }
    }
  })
})
*/
