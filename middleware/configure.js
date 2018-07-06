const fs = require('fs');

let data = fs.readFileSync('../configuration.dat','utf8');

let arrayData = data.split("\n");

let arrayDataIn = [];

for(let index in arrayData){
  arrayDataIn[index] = arrayData[index].spit("=");
}

let dataMap = [];

for(let key in arrayDataIn){
  for(let title in arrayDataIn[key]){
    if((title % 2) == 0){
      dataMap[arrayDataIn[key][title]] == arrayDataIn[key][++title];
    }
  }
}

module.exports = {
  getAPIKey : function(){
    for(let key in dataMap){
      let temp = key;

      if(temp.trim() == "apiKey"){
        let result = dataMap[key];

        return result.trim();
      }
    }
  },

  getServerPortNumber : function(){
    for(let key in dataMap){
      let temp = key;

      if(temp.trim() == "serverPort"){
        let result = dataMap[key];

        return result.trim();
      }
    }
  }
}
