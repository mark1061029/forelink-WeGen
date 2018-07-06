const mongoose = require('mongoose');

const wegenlogSchema = mongoose.Schema({
  level : String,
  user : String,
  url : String,
  time : {type : Date, default : Date.now},
  message : String
});

module.exports = mongoose.model('wegenlog',wegenlogSchema);
