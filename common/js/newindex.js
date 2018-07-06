  jQuery(document).ready(function($) {
      $('.counter1').counterUp({
          delay: 10,
          time: 1000
      });
  });


  $(document).ready(function(){

    var count = <%=subscriber%>;
    var digit = count.toString();

    console.log("digit:" + digit);
    console.log("digit.length:" + digit.length);

    var diff = 6 - digit.length  + 1;

    for(i=0; i < diff; i++) {
      $("#digit"+ i).text(0);
    }

    for(i=0; i < digit.length; i++) {
      var index = i+diff;
      $("#digit"+index).text(digit[i]);
      // console.log("#digit"+ index, digit[i]);
    }
  });


  function onlyNumber(event){
  	event = event || window.event;
  	var keyID = (event.which) ? event.which : event.keyCode;
  	if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
  		return;
  	else
  		return false;
  }

  function removeChar(event) {
  	event = event || window.event;
  	var keyID = (event.which) ? event.which : event.keyCode;
  	if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
  		return;
  	else
  		event.target.value = event.target.value.replace(/[^0-9]/g, "");
  }

  var randomNum = {};
  //0~9까지의 난수
  randomNum.random = function(n1, n2) {
      return parseInt(Math.random() * (n2 -n1 +1)) + n1;
  };
  //인증번호를 뽑을 난수 입력 n 5이면 5자리
  randomNum.authNo= function(n) {
      var value = "";
      for(var i=0; i<n; i++){
          value += randomNum.random(0,9);
      }
      return value;
  };
  //화면에 번호 출력
  randomNum.printRandom =function(data,num) {
      document.getElementById(data).innerHTML = randomNum.authNo(num);
  };

  randomNum.alertNo = function(n) {
    var certi = randomNum.authNo(n);
    certi3 = certi2;
    alert(certi);
    console.log("certi : " + certi);
  }


  var checkSMSdone = "0";
  var certi2 = "0";
  
  function numkeyCheck(e) {
  	var keyValue = event.keyCode;
  	console.log("keyValue:" + keyValue);

  	if( ((keyValue >= 48) && (keyValue <= 57)) )
  		return true;
  	else
  		return false;
  }

  function checkAgreement() {
      $("#myModal").modal();
  }

  //인증번호 받기
  $('#requestSMS').click( function() {
      var name = $("#name").val().trim();
      var phone = $("#phone").val();
      var verification = $("#verification").val();
      certi2 = randomNum.authNo(6);
      var check = "0";
      var data1 = certi2;                    //인증번호
      var data = {"data1":data1, "verification":verification, "phone":phone, "check":check, "name":name}; //post로 보낼려는 데이터

      if (phone != '') {
        $.ajax({
          url: 'https://wegen.forelink-cloud.co.kr:3200/',
          type: 'POST',
          data: data,
          success:function(data){
  	        if(data['result'] == true) {
              alert("인증번호가 전송되었습니다. ");
  	        } else {
  	        	alert("사전예약된 전화번호 입니다.");
  	        }
  	         //alert('통신성공 data : ' + data);
          },
          complete : function(data) {
              // 통신이 실패했어도 완료가 되었을 때 이 함수를 타게 된다.
              // TODO
              //alert('통신완료 data : ' + data);
  	      },
  	      error : function(xhr, status, error) {
  	            alert("에러 -  : " + status + ", xhr : " + xhr + ", error : "+ error + ", phone: "+ phone);
  	      }
      });
    } else {
      alert("전화번호를 입력해 주세요");
    }
  })

  $('#requestSMS2').click( function() {
      var name = $("#name").val().trim();
      var phone = $("#phone").val();
      var verification = $("#verification").val();
      certi2 = randomNum.authNo(6);
      var check = "0";
      var check2 = "1";
      var data1 = certi2;                    //인증번호
      var data = {"data1":data1, "verification":verification, "phone":phone, "check":check, "name":name}; //post로 보낼려는 데이터

      if (phone != '') {
        $.ajax({
          url: 'https://wegen.forelink-cloud.co.kr:3200/',
          type: 'POST',
          data: data,
          success:function(data){
  	        if(data['result'] == true) {
              alert("인증번호가 전송되었습니다. 인증번호 : "+ certi2);
  	        } else {
  	        	alert("사전예약된 전화번호 입니다.");
  	        }
  	         //alert('통신성공 data : ' + data);
          },
          complete : function(data) {
              // 통신이 실패했어도 완료가 되었을 때 이 함수를 타게 된다.
              // TODO
              //alert('통신완료 data : ' + data);
  	      },
  	      error : function(xhr, status, error) {
  	            alert("에러 -  : " + status + ", xhr : " + xhr + ", error : "+ error + ", phone: "+ phone);
  	      }
      });
    } else {
      alert("전화번호를 입력해 주세요");
    }
  })

  //인증번호확인
  $('#checkSMS').click( function() {
      var phone = $("#phone").val();
      var verification = $("#verification").val();
      var check = "1";
      var msg1 = "인증번호 일치";
      var msg2 = "인증번호 불일치";
      var data1 = certi2;
      checkSMSdone = "0";
      var data = {"verification":verification, "phone":phone , "check":check, "data1":data1, "checkSMSdone":checkSMSdone};

      if(verification != '' && phone != ''){
      $.ajax({
          url: 'https://wegen.forelink-cloud.co.kr:3200/',
          type: 'POST',
          data: data,
          success:function(data){
  	        if(data['result'] == true) {
              checkSMSdone = "1";
              alert(msg1);
  	        } else {
  	        	alert(msg2);
  	        }
  	         // alert('통신성공 data : ' + data);
          },
          complete : function(data) {
              // 통신이 실패했어도 완료가 되었을 때 이 함수를 타게 된다.
              // TODO
              //alert('통신완료 data : ' + data);
  	      },
  	      error : function(xhr, status, error) {
  	            alert("에러 -  : " + status + ", xhr : " + xhr + ", error : "+ error + ", verification: "+ verification);
  	      }
      });
    } else {
      alert("인증번호를 입력하세요.");
    }
  })

  //추천인 전화번호 번호 조회
  $('#checkPatron').click( function(){
    var patron_phone1 = $('#patron_phone1').val();
    var patronCheck = "1";
    var msg1 = "등록할 수 있는 추천인 전화번호 입니다.";
    var msg2 = "추천인 전화번호가 존재하지 않습니다.";
    var data = {"patron_phone1":patron_phone1 , "patronCheck":patronCheck};


    if(patron_phone1 != ''){
    $.ajax({
        url: 'https://wegen.forelink-cloud.co.kr:3200/',
        type: 'POST',
        data: data,
        success:function(data){
          if(data['result'] == true) {
            alert(msg1);
             // $("#verification").attr("placeholder", "인증메일이 전송되었습니다.");
          } else {
            alert(msg2);
          }
           // alert('통신성공 data : ' + data);
        },
        complete : function(data) {
            // 통신이 실패했어도 완료가 되었을 때 이 함수를 타게 된다.
            // TODO
            //alert('통신완료 data : ' + data);
        },
        error : function(xhr, status, error) {
              alert("에러 -  : " + status + ", xhr : " + xhr + ", error : "+ error + ", verification: "+ verification);
        }
    });
  } else {
    alert("추천인 전화번호를 입력하세요.");
  }
  })

  //사전예약등록 버튼
  function allSubmit(event) {

      var msg = "";
      var name = $("#name").val().trim();
      var phone = $("#phone").val().trim();
      var patron_phone1 = $("#patron_phone1").val().trim();
      var verification = $("#verification").val().trim();

      if (name == ''){
          msg = "이름을 입력해 주세요";
          alert(msg);
          return false;
      } else if (phone == ''){
          msg = "휴대폰 번호를 입력해 주세요";
           alert(msg);
           return false;
      } else if (verification == ''){
          msg = "인증 번호를 입력해 주세요";
           alert(msg);
           return false;
      } else if (checkSMSdone != "1") {
        msg = "인증번호를 확인해 주세요";
        alert(msg);
        return false;
      } else if ($("#chkAgree").is(":checked") != true){
        msg = "개인정보 수집 및 문자 수신에 동의 해 주세요";
        alert(msg);
        return false;
      } else if (phone == patron_phone1) {
        msg = "예약자와 추천인의 전화번호가 같을 수 없습니다.";
        alert(msg);
        return false;
      } else if (patron_phone1 == ''){
        if (confirm('추천인 없이 등록을 진행 하시겠습니까??')) {
          var data = {"name":name, "phone":phone, "patron_phone1":patron_phone1, "verification":verification};
          updatecss/reservation(data);
          return;
        } else {
          msg = "추천인의 전화번호를 입력해 주세요";
          alert(msg);
          return false;
        }
      }

  }

  function email_check( email ) {
      var regex=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      return (email != '' && email != 'undefined' && regex.test(email));
  }

  // check when email input lost foucus
  $(".in_email").blur(function(){
    var email = $(this).val();

    // if value is empty then exit
    if( email == '' || email == 'undefined') return;

    // valid check
    if(! email_check(email) ) {
    	$("#result-check").text('Not valid email.');
      alert("유효하지않은 이메일형식 입니다.");
      // $(this).focus();
      return false;
    }
    else {
    	$("#result-check").text('Email address test OK.');
    }
  });

  function phone_check( text ){
    var regExp = /^(01[016789]{1})([0-9]{3,4})([0-9]{4})$/;
    return ( text != '' && text != 'undefined' && regExp.test(text));
  }

  $(".in_phone").blur(function(){
    var text = $(this).val();
    if ( text == '' || text == 'undefined') return;

    if(! phone_check( text) ) {
      $("#result-check").text('Not valid phone.');
      alert("유효하지않은 폰번호입니다.")
      return false;
    }
    else {
      $("#result-check").text('phone number test OK.');
    }
  });

  $(".in_phone2").blur(function(){
    var text = $(this).val();
    if ( text == '' || text == 'undefined') return;

    if(! phone_check( text) ) {
      $("#result-check").text('Not valid phone.');
      alert("유효하지않은 폰번호입니다.")
      return false;
    }
    else {
      $("#result-check").text('phone number test OK.');
    }
  });

    $(document).ready(function(){

      //url 파라미터 읽어오는 함수
      var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
          }
        }
      };

      var partonPhone = getUrlParameter('code');

      //정규표현식 전화번호만 남기기
      partonPhone = partonPhone.replace(/\-/g,'');
      partonPhone = partonPhone.replace(/^\s+/,'');
      partonPhone = partonPhone.replace(/\s+$/,'');
      partonPhone = partonPhone.replace(/^\s+|\s+$/g,'');
      partonPhone = partonPhone.replace(/\s/g,'');
      partonPhone = partonPhone.replace(/\n/g,'');
      partonPhone = partonPhone.replace(/\r/g,'');

      $('#patron_phone1').val(partonPhone);
    })
