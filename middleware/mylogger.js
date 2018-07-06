const wegenlog = require('../models/wegenlog');

module.exports = {
  log : function(input){
    let log = {};
    for(let index in input){

      if(index == 'level'){
        log[index] = input[index]
      }
      if(index == 'user'){
        log[index] = input[index]
      }
      if(index == 'url'){
        log[index] = input[index]
      }
      if(index == 'message'){
        log[index] = input[index]
      }
    }
    console.log(log);
    wegenlog.insertMany(log,(err,result)=>{
      if(err){
        console.log("mylogger - mongodb - wegenlog err");
      }else {
        console.log("mylogger - log saved");
      }
    })
  }
}
