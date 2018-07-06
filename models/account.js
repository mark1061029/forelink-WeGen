const mongoose = require('mongoose');
const dateFormat = require('dateformat');


const accountSchema = mongoose.Schema({
  addr : String,
  from : String,
  to : String,
  description : String,
  memo : String,
  date : String,
  input : String,
  output : String,
  balance : Number
});

module.exports = mongoose.model('accountInfo',accountSchema);
