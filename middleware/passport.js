const LocalStrategy = require('passport-local').Strategy;
const Users = require('../models/user.js');
const multichain = require('./multichain-connection');
const mongoose = require('./mongo-connection'); // added by leepg
const nev = require('./email-verification-nev'); // added by leepg

module.exports = (passport)=>{
  passport.serializeUser((user, done)=>{
    done(null, user);
  });

  passport.deserializeUser((user, done)=>{
    done(null, user);
  });

  // if we use passport, it check uniqness of email
  const createUserViaEmail = true;  // added by leepg
  const dupEmailDisable = true;     // true for findId

  passport.use('signup',new LocalStrategy({
    usernameField : 'email',
    passwordField : 'pwd',
    passReqToCallback : true
  },(req,email,pwd,done)=>{
    Users.findOne({'email' : email}, (err,user)=>{ // email checking added by leepg
      if(err){
        console.log(email + " already used");
        return done(err);
      }
      if(user){
        console.log(email + " already exist");
        return done(null,false,{message : '이미 가입된 이메일 주소입니다.'});
      }

      let pwd2 = req.body.pwd2;
      let name = req.body.name;
      let email = req.body.email;
      
      let newUser = new Users();
      newUser.name = req.body.name;
      newUser.pwd = req.body.pwd;
      newUser.email = req.body.email;
      newUser.phone = req.body.phone;

      if(pwd !== pwd2){
        console.log('passwords do not match');
        return done(null,false,{message : '비밀번호가 일치하지 않습니다. 다시 시도해 주세요'});
      }
      multichain.getNewAddress((err,addr)=>{
        if(err){
          console.log('creation new address in multichain failed');
          console.log(err);
          throw err;
        }
        console.log('new address created in multichain');
        // added by leepg to change default permission
        multichain.grant({addresses:addr,permissions:'send,receive'},(err,data)=>{
          if(err){
            console.log('permission grant of new address in multichain failed');
            console.log(err);
            throw err;
          }
          //
          newUser.addr = addr;

          if(!createUserViaEmail){
            newUser.pwd = newUser.generateHash(pwd);
            newUser.save((err)=>{
              if(err){
                throw err;
              }
              console.log("user saved in db successfully");
              return done(null,newUser);
            });
          }else{ // added by leepg for 2-step email verification
            console.log('try to create tempuser at ' + (new Date()).toISOString().substring(0,19));
            nev.createTempUser(newUser, function(nevErr, existingPersistentUser, newTempUser){
              if(nevErr) {
                console.error(nevErr);
                throw nevErr;
              }
              if(newTempUser){
                console.log('tempuser created');
                //console.log(newTempUser);
                var URL = newTempUser[nev.options.URLFieldName];
                console.log('verification url = ' + URL /* + ' newTempUser[' + nev.options.URLFieldName + ']'*/);
                nev.sendVerificationEmail(email, URL, function(eErr, info){
                  if(eErr) {
                    console.log(eErr);
                    //throw eErr;
                    return done(null,false,{message : '메일 시스템에 접속하지 못했습니다. 운영자에게 연락하세요.'});
                  }
                  console.log('An email has been sent to you. Please check it to verify your account.');
                  return done(null,false,{message : name + '(' + email + ')님에게 가입확인 메일이 발송되었습니다. ' +
                              '확인해 주세요.'});
                });
              }else{
                // TODO: if user will not confirm, remove automatically tempUser after timer
                console.log('You have already signed up. Please check your email to verify your account.');
                return done(null,false,{message : '이미 가입 신청된 계정입니다. 이메일을 확인해 주세요.'});
              }
            });
          }
        });
      });
    });
  }));

  passport.use('login',new LocalStrategy({
    usernameField: 'email',
    passwordField: 'pwd',
    passReqToCallback : true,
  },(req,email, pwd, done) =>{
    Users.findOne({'email' : email}, (err, user) => {
      console.log("INPUT USER ID : " + email + " at " + (new Date()).toISOString().substring(0,19));
      console.log("INPUT USER PW : " + pwd);
      console.log("disabled : " + user.disabled);
      if (user && /*reduce message*/ false) { // added by leepg to avoid abort when not exist id input
         console.log("USER ID : " + user.email);
         console.log("USER PW : " + user.pwd);
         console.log("PW CHECK : "+ user.validPassword(pwd,user.pwd));
      }
      if(err){
        return done(err);
      }

      if(user.disabled == true){
        console.log("????");
        return done(null, false, {message : '존재하지 않는 아이디입니다.'});
      }

      if(!user){
        return done(null, false, {message : '존재하지 않는 아이디입니다.'});
      }else{
        if(!user.validPassword(pwd,user.pwd)){
          return done(null, false, {message : '비밀번호 입력 오류입니다.'});
        }
      }

      return done(null,user);
    });
  }));
}
