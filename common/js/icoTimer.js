function icoTimer(startTime,endTime){

  let startDate = new Date(startTime).getTime();
  let endDate = new Date(endTime).getTime();

  let x = setInterval(function(){

    let now = new Date().getTime();

    let distance = startDate - now;

    if(startDate < now){
      distance = endDate - now;
    }

    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % ( 1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000* 60 )) / 1000 );



    if(startDate > now){
      document.getElementById("timerComment").innerHTML = "ICO 시작까지 남은시간"
      document.getElementById("start-timer").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초 ";
    }else if(startDate < now){
      document.getElementById("timerComment").innerHTML = "ICO 종료까지 남은시간"
      document.getElementById("start-timer").innerHTML = days + "일 " + hours + "시간 " + minutes + "분 " + seconds + "초 ";
    }

    if (distance < 0) {
      clearInterval(x);
      document.getElementById("timerComment").innerHTML = "ICO 참여 기간이 아닙니다";
      document.getElementById("start-timer").innerHTML = "";
    }
  },1000);
}
