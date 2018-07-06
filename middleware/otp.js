const otp = require('otp.js');

let GA = otp.googleAuthenticator;

module.exports = {
  generate : function(otpKey){

    let code = GA.gen(GA.encode(otpKey));

    return code;
  },

  verification : function(userInput,otpKey){

    let result;

    console.log(userInput);

    if(userInput.length != 6){
      return null;
    }else{
      result = GA.verify(userInput,GA.encode(otpKey));
    }

    return result;
  },

  qrCodeGenerate : function(otpKey){

    let secret = GA.encode(otpKey) || GA.secret();

    let qrCode = GA.qrCode('CGM_Coin', 'GoogleOTP', secret);

    return qrCode;
  }
}
