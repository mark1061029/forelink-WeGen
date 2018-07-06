const mongoose = require('mongoose');

const reservationSchema = mongoose.Schema({
  index : Number,
  phone : String,
  name : String,
  // email : String,
  // patron : {type: String, default: 'NoPatron' },
  patron_name : String,
  patron_phone : {type: String, default: 'NoPatron' },
  patronCount : { type: Number, defult: 0},
  // chkAgree : {type : Boolean, default : false},
  location : String,
  date : String,
  dateDay : String
});

module.exports = mongoose.model('reservation',reservationSchema);
