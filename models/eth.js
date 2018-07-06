const mongoose = require('mongoose');

const ethSchema = mongoose.Schema({
  blockNumber : String,
  from : String,
  to : String,
  value : Number,
  txHash : String,
  timestamp : String,
  complete : {type : Boolean, default : false}
});

module.exports = mongoose.model('eth',ethSchema);
