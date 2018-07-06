function otpCheck(){

  let userId = $('#inputId').val();
  let userPwd = $('#inputPassword').val();

  if(userId == admin){
    let otpCodeInput = document.createElement("input");

    otpCodeInput.setAttribute("type","text");
    otpCodeInput.setAttribute("id","OTP");
    otpCodeInput.setAttribute("class","form-control");
    otpCodeInput.setAttribute("required",true);

    let otpSubmit = document.createElement("button");

    otpSubmit.setAttribute("type","submit");
    otpSubmit.setAttribute("class","btn btn-lg btn-primary btn-block");
    otpSubmit.setAttribute("onclick",adminLogin());

    $('#otp').append(otpCodeInput);
    $('#otp').append(otpSubmit);

  }else{
    let method = "post";

    let form = document.createElement("form");
    form.setAttribute("method",method);
    form.setAttribute("action","/login");

    let hiddenIdField = document.createElement("input");
    hiddenField.setAttribute("type","hidden");
    hiddenField.setAttribute("name","id");
    hiddenField.setAttribute("value",userId);

    let hiddenPwdField = document.createElement("input");
    hiddenPwdField.setAttribute("type","hidden");
    hiddenPwdField.setAttribute("name","pwd");
    hiddenPwdField.setAttribute("value",userPwd);

    form.appendChild(hiddenIdField);
    form.appendChild(hiddenPwdField);

    document.body.appendChild(form);

    form.submit();
  }
}
