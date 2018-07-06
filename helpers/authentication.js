module.exports = {
  isLoggedIn : function(req,res,next){
    if(req.isAuthenticated()){
      return next();
    }else{
      res.redirect('/')
    }
  },

  isAdmin : function(req,res,next){
    console.log(req.user);
    if(req.isAuthenticated() && (req.user.isAdmin)){
      return next();
    }else{
      res.redirect('/');
    }
  },

  getLoggedUser : function(req){
    /*
    if(req.user){
      return req.user;
    }else{
      return "";
    }
    */

    return req;
  },

  getEffectDate : function(input){
    let now = new Date();

    let nowDate =  now.toFormat('YYYY-MM-DD HH24:MI');

    let result;

    for(let i in input){
      if(nowDate > input[i].effectDate){
        result = input[i];
        break;
      }
    }

    if(typeof(result) == "undefined"){
      result = input[0];
    }
    return result;
  }
}
