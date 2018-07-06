const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const passport = require('passport');
const http = require('http');   // for https
const https = require('https'); // for https
const fs = require('fs');       // for https
const i18n = require('i18n-express');
const path = require('path');
const swal = require('sweetalert2');
const nodemailer = require('nodemailer'); // by hscho 사전예약시 이메일 번호 인증


const ico = require('./middleware/ico.js');
const sysInfo = require('./models/systemInfo.js');
const WeGen_conf = require('./helpers/conf.json');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: WeGen_conf.smtpGmail,
      pass: WeGen_conf.smtpGmailPwd
    }
});
var emailSender = 'Gmov <noreply@gmail.com>';
var noreplyTail = '<i><small>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</small></i>';
var notifyViaEmail = true;

/*
const options = {               // for https
  key:  fs.readFileSync('certkey/key.pem'),
  cert: fs.readFileSync('certkey/cert.crt')
};
*/

const app = express();

var flash = require('connect-flash'); // added by leepg for login error message

require('./middleware/passport.js')(passport);

app.set('views',__dirname+'/views');
app.set('view engine', 'ejs');
app.engine('html', require('ejs').renderFile);

app.use(express.static(__dirname + '/common'));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended : true}));

app.use(
  session({
  secret : WeGen_conf.assetname,
  resave : true,
  saveUninitialized : false,
  // added by leepg for autologout after inactivity (no ui, session timeout only)
  rolling : true,
  cookie : { expires: 10 * 60 * 1000 } // 10 minute
  })
);

//사전예약 인증번호
app.post('/reserNumber',function(req,res) {

})


  // if(req.session.cookie.expires <= 60000){
  //   swal({
  //   title: '연장하시겠습니까?',
  //   text: "클릭이 없어도 자동 로그아웃됩니다.",
  //   timer: 60000,
  //   type: 'warning',
  //   showCancelButton: true,
  //   confirmButtonColor: '#3085d6',
  //   cancelButtonColor: '#d33',
  //   confirmButtonText: '10분으로 연장',
  //   cancelButtonText: '로그아웃',
  //   confirmButtonClass: 'btn btn-success',
  //   cancelButtonClass: 'btn btn-danger',
  //   buttonsStyling: false,
  //   reverseButtons: true
  // }).then((result) => {
  //   if (result.value) {
  //     swal(
  //       'Deleted!',
  //       'Your file has been deleted.',
  //       'success'
  //     )
  //     return session.cookie.expires = 600000;
  //   } else if (
  //     // Read more about handling dismissals
  //     result.dismiss === swal.DismissReason.cancel
  //   ) {
  //     swal(
  //       '로그아웃',
  //       'Your imaginary file is safe :)',
  //       'error'
  //     )
  //     return session.cookie.expires = 1000;
  //   }
  // })
  // }

//로그인 세션 관리 모듈
app.use(passport.initialize());
app.use(passport.session());

//다국어
app.use(i18n({
  translationsPath : path.join(__dirname, 'middleware/locales'),
  siteLangs : ["en","kor"],
  defaultLang : 'kor',
  textsVarName : 'i18n'
}));

//ico 작업 - 임시 처리 (차후 변경 예정)

/*
setInterval(function(){
  ico.getEthereumTransaction();
},1000*60);
*/


//ico 테스트
//서버 내부에서 작동하는 함수를 어디에 저장하여야 할지 결정을 못내렸음.

sysInfo.count({},(err,index)=>{
  if(err){
    console.log("mongo-sys : " + err);
    throw err;
  }else{
    sysInfo.findOne({index : index},(err,systemInfo)=>{
      if(err){
        console.log("mongo-sys : " + err);
        throw err;
      }else{
        if(systemInfo != null){
          if(systemInfo.testMode == true){
            setInterval(function(){
              ico.icoProgressTest(systemInfo.ethAddr);
            },1000 * 30);
          }else{
            setInterval(function(){
              ico.icoProgress();
            },1000 * 30);
          }
        }
      }
    });
  }
});

app.use(flash()); // added by leepg for login error message
app.use(require('./controllers/router.js'));

const portn = parseInt(WeGen_conf.portn, 10);;  // original 80
const ports = parseInt(WeGen_conf.ports, 10);;  // original 443
const newurl = 'wegen.forelink-cloud.co.kr';
const sslcert = {    // for https
  key:  fs.readFileSync('/etc/httpd/certkey/star-forelink-cloud.co.kr_private.key'),
  cert: fs.readFileSync('/etc/httpd/certkey/star-forelink-cloud.co.kr_cert.crt'),
  ca:   fs.readFileSync('/etc/httpd/certkey/star-AddTrust_External_CA_Root.crt')
};
/*
http.createServer(function(req, res) {
   //r url = req.headers['host'].replace(/:[^:]*$/,''); // remove port number
   console.log('http redirect to https://' + newurl + ':' + ports + req.url);
   res.writeHead(301, {"Location": "https://" + newurl + ':' + ports + req.url}); // redirect ot https
   res.end();
}).listen(portn);
*/
http.createServer(app).listen(portn);
https.createServer(sslcert, app).listen(ports, function(){
   console.log('Express running on https://localhost:' + ports);
});
