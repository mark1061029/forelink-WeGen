
function fn_regReferral() {
	// email Validations
	var referral = $("#referral").val();
	var frm = document.frmReferral;


    frm.setAttribute("action", "token buy.html");

	if(referral.length < 1)	{
		alert("Referral을 입력하세요.");
		return ;
	}

	$.ajax({
		"type":'post',
		"dataType":'text',
		"url": '/ajax/common/setReferral.do',
		"async": false,
		"data": {
			referral: referral
		}
	}).done(function(result){

		if(result == "TRUE"){
			alert( "Referral이 등록되었습니다." );
			document.frmReferral.submit();
		}else if( result == "REFERRAL_REG_FAIL") {
			alert( "Referral 등록에 실패하였습니다." );
			var  ref = document.getElementById("referral") ;
			ref.focus();
		}else{
			alert( "Referral 등록에 실패하였습니다." );
			var  ref = document.getElementById("referral") ;
			ref.focus();
		}
	}).fail(function(result){
		//fail
		alert("Referral 등록에 실패하였습니다." );
	});
}


function fn_regWallet()	{

	// email Validations
	var wallet = $("#wallet").val();
	var frm = document.frmWallet;
	var web3 = new Web3();
    var isvalid = web3.isAddress(wallet);

    var isReg = confirm("입력이 완료된  WALLET 주소는 변경할 수 없습니다. 진행하시겠습니까?");

    if(!isReg)	{
    	return;
    }


	frm.setAttribute("action", "token buy.html");

	if(wallet.length < 1)	{
		alert("wallet 주소를 입력하세요");
		return ;
	}else if(!isvalid){
		alert("입력하신 wallet 주소는 유효하지 않은 주소입니다");
		return ;
	}


	$.ajax({
		"type":'post',
		"dataType":'text',
		"url": '/ajax/common/setWallet.do',
		"async": false,
		"data": {
			wallet: wallet
		}
	}).done(function(result){

		//	success
		//alert("사용자 조회 성공 : " + result + ", result.length = " + result.length);
		if(result == "TRUE"){
			alert( "wallet 주소가 등록되었습니다." );
			document.frmWallet.submit();
		}else if( result == "WALLET_REG_FAIL") {
			alert( "wallet 주소 등록에 실패하였습니다" );
			var  wall = document.getElementById("wallet") ;
			wall.focus();
		} else if(result == "WALLET_ALREADY_EXIST"){
			alert( "이미 존재하는 wallet 주소입니다" );
			var  wall = document.getElementById("wallet") ;
			wall.value = "";
			wall.focus();
		}else{
			alert( "wallet 주소 등록에 실패하였습니다!" );
			var  wall = document.getElementById("wallet") ;
			wall.focus();
		}
	}).fail(function(result){
		//fail
		alert("wallet 주소 등록에 실패하였습니다" );
	});

}

function enterKey(e) {

	e =e || window.event;
	if ( e.keyCode == 13 ) {
		fn_regWallet();
		return false;
	} else {
		return true;
	}
}
