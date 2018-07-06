const mongoose = require('mongoose');

const SMSSchema = mongoose.Schema({
  phoneNo : String,
  checkNumber : String,
  date : String
});

module.exports = mongoose.model('SMS',SMSSchema);
