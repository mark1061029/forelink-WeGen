const WeGen_conf = require('./conf.json');

module.exports = {
  getAddressBalances : function(result){
    let amount = 0;

    for(let index in result){
      if(result[index].name == WeGen_conf.assetname ){
        for(let key in result[index]){
          if(key == 'qty'){
            amount = result[index][key];
          }
        }
      }
    }

    return amount;
  },

  isEmpty : function(obj){
    for(let index in obj){
      if(obj.hasOwnProperty(index)){
        return false;
      }
    }
    return true;
  },
}
