const mongoose = require('mongoose');

const icoSchema = mongoose.Schema({
  userId : String,
  userEmail : String,
  ethCoin : Number,
  ethAddr : String,
  cgmCoin : Number,
  cgmAddr : String,
  icoType : String,
  timeStamp : String
});

module.exports = mongoose.model('ico',icoSchema);
