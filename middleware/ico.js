const async = require('async');
const nodemailer = require('nodemailer');

const multichain = require('./multichain-connection');

const user = require('../models/user');
const sys = require('../models/systemInfo');
const ico = require('../models/ico');
const eth = require('../models/eth');
const wallet = require('../helpers/wallet');
const accountInfo = require('../models/account.js');
const auth = require('../helpers/authentication');

const WeGen_conf = require('../helpers/conf.json');

var smtpTransport = nodemailer.createTransport("SMTP", {
    service: 'Gmail',
    auth: {
      user: 'forelinkg@gmail.com',
      pass: 'forelink10!'
    }
});
var emailSender = 'Gmov <noreply@gmail.com>';
var noreplyTail = '<i>* 이 메일주소는 발신전용 주소입니다. 회신이 불가능합니다.</i>';

let now = new Date();

module.exports = {
  getEthereumTransaction : function(){
    async.waterfall([
      function(callback){

        sys.find({}).sort({effectDate:-1}).exec((err,result)=>{
          let info = auth.getEffectDate(result);
          sys.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,systemInfo)=>{
            if(err){
              callback(true,"mongodb_err");
              return;
            }else{
              if(result==null){
                callback(true,"mongodb_null");
                return;
              }else{
                callback(null,systemInfo);
              }
            }
          });
        });
      },

      function(systemInfo,callback){
        const etherscan = require('etherscan-api').init(systemInfo.apiKey);

        let blockCount;
        let adminEthAddr = systemInfo.ethAddr

        if(systemInfo.latestBlock == null || Number(systemInfo.latestBlock) == 0){
          blockCount = 0;
        }else{
          blockCount = Number(systemInfo.latestBlock);
        }
        let tx = etherscan.account.txlist(adminEthAddr,blockCount,'latest','asc');

        //let tx = etherscan.account.txlist("0x0E25c1fd8F7a57511Fd78cE5d8B427B60e6489C0",blockCount,'latest','asc');
        //test 결과 최대 조회 갯수는 10000개

        tx.then((result)=>{
          let txList = result['result'];

          let ethList = [];
          let count = 0;

          for(listIndex in txList){
            let ethRecord = {
              blockNumber : txList[listIndex]['blockNumber'],
              blockHash : txList[listIndex]['blockHash'],
              from : txList[listIndex]['from'],
              value : txList[listIndex]['value'],
              timeStamp : txList[listIndex]['timeStamp'],
              to : txList[listIndex]['to'],
              complete : false
            }

            ethList[count] = ethRecord;
            count++;
          }

          callback(null,ethList);
        });
      },

      function(ethList,callback){
        let newEthList = [];

        eth.find({},(err,result)=>{
          if(err){
            console.log("mongo-eth : " + err);
            callback(true,"mongodb_err");
            return;
          }else{
            if(result.length == 0){
              callback(null,ethList);
              return;
            }else{
              for(index in ethList){
                let count = 0;
                for(key in result){
                  if(result[key].blockNumber == ethList[index].blockNumber){

                    count++;
                  }
                }
                if(count ==0){
                  newEthList.push(ethList[index]);
                }
              }

              callback(null,newEthList);
              return;
            }
          }
        })
      },

      function(newEthList, callback){
        if(newEthList.length != 0){
          eth.collection.insertMany(newEthList,(err,ethRes)=>{
            if(err){
              console.log("mongo-eth : " + err);
              callback(true,'mongodb_err');
              return;
            }else{
              callback(null);
              return;
            }
          });
        }else{
          callback(true,"no_data");
          return;
        }
      }
    ],function(err,result){
      if(result=="mongodb_err"){
        console.log("Mongodb Update Failed");
      }else if(result == "no_data"){
        console.log("No Update Data");
      }else{
        console.log("Mongodb Updated");
        sys.count({},(err,index)=>{
          if(err){
            console.log("mongo-sys : " + err);
            callback(true,"mongodb_err");
            return;
          }else{
            eth.findOne({},{blockNumber:1}).sort({blockNumber:-1}).limit(1).exec((err,res)=>{
              let latestBlock = res.blockNumber;
              sys.update({index:index},{$set:{latestBlock:Number(latestBlock)}},(err,res)=>{
                if(err){
                  throw err;
                }else{
                  console.log("block counted");
                }
              });
            });
          }
        });
      }
    });
  },

  icoProgress : function(){
    eth.find({'complete':false},(err,ethList)=>{
      if(err){
        //
        console.log("Error occured while using MongoDB");
        throw err;
      }else{
        if(ethList == null){

        }else{
          user.find({'disabled' : false},(err,userList)=>{
            user.findOne({'isAdmin' : true},(err,adminInfo)=>{


              if(err){
                //
                console.log("Error occured while using MongoDB");
                throw err;
              }else{
                for(let ethIndex in ethList){
                  for(let userIndex in userList){
                    if(ethList[ethIndex].from == userList[userIndex].ethAddr){
                      let ico = {
                        userId : userList[userIndex].id,
                        ethAddr : userList[userIndex].ethAddr,
                        addr : userList[userIndex].addr,
                        value : ethList[ethIndex].value,
                        timeStamp : ethList[ethIndex].timeStamp
                      };
                      async.waterfall([
                        function(callback){

                          sys.find({}).sort({effectDate:-1}).exec((err,result)=>{
                            let info = auth.getEffectDate(result);
                            sys.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,systemInfo)=>{
                              if(err){
                                callback(true,"mongodb_err");
                                return;
                              }else{
                                if(result==null){
                                  callback(true,"mongodb_null");
                                  return;
                                }else{
                                  callback(null,systemInfo)
                                }
                              }
                            });
                          });
                        },

                        function(sysInfo,callback){
                          let rate = sysInfo[0].rate;
                          let qty = ( Number(rate) * Number(ico.value) ) / ( 10000000000 * 100000000 ) ;

                          //ethereum의 밸류값
                          //소수점8자리 + 0 10자리
                          //1.175 이더리움의 예
                          // 1175000000000000000

                          multichain.issueMoreFrom({
                            from : WeGen_conf.multichainAdminAddress, //운영자 주소
                            to : ico.addr,
                            asset : WeGen_conf.assetname, //사용할 asset 이름
                            qty : Number(qty)
                          },(err,res)=>{
                            if(err){
                              console.log(err);
                              callback(true,"multichain_err");
                              return;
                            }else{
                              let ledger = [{
                                from : ico.userId,
                                to : adminInfo.email,
                                input : qty,
                                output : "",
                                description : sysInfo.icoType,
                                memo : "ICO참가",
                                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                                balance : "",
                              },{
                                from : adminInfo.email,
                                to : ico.userId,
                                input : "",
                                output : qty,
                                description : sysInfo.icoType,
                                memo : "ICO참가",
                                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                                balance : ""
                              }];

                              callback(null,ledger);
                            }
                          });
                        },

                        function(ledger,callback){
                          multichain.getAddressBalances({address : ico.addr},(err,asset)=>{
                            if(err){
                              //
                              throw err;
                              callback(true,"multichain_err");
                              return;
                            }else{
                              let balance = wallet.getAddressBalances(asset);

                              ledger[0].balance = Number(balance);

                              callback(null,ledger);
                            }
                          });
                        }
                      ],function(err,res){
                        if(res == "mongodb_err"){
                          console.log("Error occured while reading mongoDB");
                        }else if(res == "mongodb_null"){
                          consol.elog("No mongoDB data");
                        }else if(res == "multichain_err"){
                          console.log("Error while using multichain");
                        }else if(res == "no_ico"){
                          //console.log("No ICO participator");
                        }else{
                          user.findOne({id:res[0].to},(err,userInfo)=>{
                            if(err){
                              console.log("Error while reading mongoDB");
                              throw err;
                            }else{
                              sys.find({}).sort({effectDate:-1}).exec((err,result)=>{
                                let info = auth.getEffectDate(result);
                                sys.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,sysResult)=>{
                                  if(err){
                                    throw err;
                                  }else{
                                    if(result==null){

                                    }else{
                                      let deskemail = sysResult[0].deskemail;
                                      let rate = sysResult[0].rate;

                                      let value = res[0].input / rate;
                                      //systeminfo 테이블에 대한 수정이 우선

                                      let mailHtml = '<p>Gmov ICO 참여를 환영합니다.</p>' +
                                                     '<table>' +
                                                     '<tr><td>거래일시</td><td>:</td><td>'+ now.toFormat('YYYY-MM-DD HH24:MI:SS') +'</td></tr>' +
                                                     '<tr><td>구매자</td><td>:</td><td>'+ userInfo.name +'</td></tr>' +
                                                     '<tr><td>지불금액</td><td>:</td><td>'+ value +'</td></tr>' +
                                                     '<tr><td>교환율</td><td>:</td><td>'+ rate +'</td></tr>' +
                                                     '<tr><td>Gmov금액</td><td>:</td><td>'+ res[0].input +'</td></tr>' +
                                                     '</table>';


                                      let mailText = 'Gmov ICO 참여를 환영합니다.' +
                                                     '거래일시 : ' + now.toFormat('YYYY-MM-DD HH24:MI:SS') +
                                                     '구매자 : ' + userInfo.name +
                                                     '지불금액 : ' + value +
                                                     '교환율 : ' + rate +
                                                     'Gmov금액 : ' + res[0].input ;

                                      //구버전 - 신버전으로 변환 확정이 안된 상태
                                      /*
                                      let toMailOptions = {
                                        from : emailSender,
                                        to : userInfo.name + '<' + userInfo.email + '>',
                                        subject : '나눔코인 \'발급\' 알림 메일입니다',
                                        html : '관리로부터 나눔코인 <b>' + res[0].input + '원</b>이 발행되었습니다.<br>' +
                                               '<br>' + noreplyTail +'기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                                        text : '관리자로부터 나눔코인' + res[0].input + '원이 발행되었습니다.'
                                      };
                                      */

                                      //신버전 - 미확정

                                      let toMailOptions = {
                                        from : emailSender,
                                        to : userInfo.name + '<' + userInfo.email + '>',
                                        subject : 'Gmov \'발급\' 알림 메일입니다.',
                                        html : mailHtml,
                                        text : mailText
                                      };

                                      smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                                        if(toEmailErr){
                                          console.log(toEmailErr);
                                        }else{
                                          console.log("message sent to " + userInfo.email + " : " + toEmailRes.message);
                                          //smtpTransport.close();
                                        }
                                      });

                                      //ICO 참가 완료
                                      eth.update({'txHash':ethList[ethIndex].txHash},{$set:{'complete':true}},(err,updateRes)=>{
                                        if(err){
                                          console.log("Error occured while reading mongoDB")
                                        }else{
                                          accountInfo.insertMany(res,(err,result)=>{
                                            if(err){
                                              console.log("Mongodb Error");
                                            }else{
                                              console.log("ICO Completed");
                                            }
                                          });
                                        }
                                      });
                                    }
                                  }
                                })
                              });
                            }
                          });
                        }
                      });
                    }
                  }
                }
              }
            });
          })
        }
      }
    });
  },

  icoProgressTest : function(input){
    eth.find({'complete':false},(err,ethList)=>{
      if(err){
        //
        console.log("Error occured while using MongoDB");
        throw err;
      }else{
        if(ethList == null){

        }else{
          user.find({'disabled' : false},(err,userList)=>{
            user.find({'isAdmin' : true},(err,adminInfo)=>{
              console.log(adminInfo);

              if(err){
                //
                console.log("Error occured while using MongoDB");
                throw err;
              }else{
                for(let ethIndex in ethList){
                  for(let userIndex in userList){
                    if(ethList[ethIndex].from == userList[userIndex].ethAddr){
                      let ico = {
                        userId : userList[userIndex].id,
                        ethAddr : userList[userIndex].ethAddr,
                        addr : userList[userIndex].addr,
                        value : ethList[ethIndex].value,
                        timeStamp : ethList[ethIndex].timeStamp
                      };
                      async.waterfall([
                        function(callback){

                          sys.find({}).sort({effectDate:-1}).exec((err,result)=>{
                            let info = auth.getEffectDate(result);
                            sys.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,systemInfo)=>{
                              if(err){
                                callback(true,"mongodb_err");
                                return;
                              }else{
                                if(result==null){
                                  callback(true,"mongodb_null");
                                  return;
                                }else{
                                  callback(null,systemInfo)
                                }
                              }
                            });
                          });
                        },

                        function(sysInfo,callback){
                          let rate = sysInfo[0].rate;
                          let qty = ( Number(rate) * Number(ico.value) ) / ( 10000000000 * 100000000 ) ;

                          //ethereum의 밸류값
                          //소수점8자리 + 0 10자리
                          //1.175 이더리움의 예
                          // 1175000000000000000

                          console.log(ico.userId);
                          console.log(adminInfo.email);

                          multichain.issueMoreFrom({
                            from : WeGen_conf.multichainAdminAddress, //운영자 주소
                            to : ico.addr,
                            asset : WeGen_conf.assetname, //사용할 asset 이름
                            qty : Number(qty)
                          },(err,res)=>{
                            if(err){
                              console.log(err);
                              callback(true,"multichain_err");
                              return;
                            }else{
                              let ledger = [{
                                from : ico.userId,
                                to : adminInfo.email,
                                input : qty,
                                output : "",
                                description : sysInfo.icoType,
                                memo : "ICO참가",
                                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                                balance : "",
                              },{
                                from : adminInfo.email,
                                to : ico.userId,
                                input : "",
                                output : qty,
                                description : sysInfo.icoType,
                                memo : "ICO참가",
                                date : now.toFormat('YYYY-MM-DD HH24:MI:SS'),
                                balance : ""
                              }];

                              callback(null,ledger);
                            }
                          });
                        },

                        function(ledger,callback){
                          multichain.getAddressBalances({address : ico.addr},(err,asset)=>{
                            if(err){
                              //
                              throw err;
                              callback(true,"multichain_err");
                              return;
                            }else{
                              let balance = wallet.getAddressBalances(asset);

                              ledger[0].balance = Number(balance);

                              callback(null,ledger);
                            }
                          });
                        }
                      ],function(err,res){
                        if(res == "mongodb_err"){
                          console.log("Error occured while reading mongoDB");
                        }else if(res == "mongodb_null"){
                          consol.elog("No mongoDB data");
                        }else if(res == "multichain_err"){
                          console.log("Error while using multichain");
                        }else if(res == "no_ico"){
                          //console.log("No ICO participator");
                        }else{
                          user.findOne({id:res[0].to},(err,userInfo)=>{
                            if(err){
                              console.log("Error while reading mongoDB");
                              throw err;
                            }else{
                              sys.find({}).sort({effectDate:-1}).exec((err,result)=>{
                                let info = auth.getEffectDate(result);
                                sys.find({effectDate:info.effectDate}).sort({updateTime:-1}).limit(1).exec((err,sysResult)=>{
                                  if(err){
                                    throw err;
                                  }else{
                                    if(result==null){

                                    }else{
                                      let deskemail = sysResult[0].deskemail;
                                      let rate = sysResult[0].rate;

                                      let value = res[0].input / rate;
                                      //systeminfo 테이블에 대한 수정이 우선

                                      let mailHtml = '<p>Gmov ICO 참여를 환영합니다.</p>' +
                                                     '<table>' +
                                                     '<tr><td>거래일시</td><td>:</td><td>'+ now.toFormat('YYYY-MM-DD HH24:MI:SS') +'</td></tr>' +
                                                     '<tr><td>구매자</td><td>:</td><td>'+ userInfo.name +'</td></tr>' +
                                                     '<tr><td>지불금액</td><td>:</td><td>'+ value +'</td></tr>' +
                                                     '<tr><td>교환율</td><td>:</td><td>'+ rate +'</td></tr>' +
                                                     '<tr><td>Gmov금액</td><td>:</td><td>'+ res[0].input +'</td></tr>' +
                                                     '</table>';


                                      let mailText = 'Gmov ICO 참여를 환영합니다.' +
                                                     '거래일시 : ' + now.toFormat('YYYY-MM-DD HH24:MI:SS') +
                                                     '구매자 : ' + userInfo.name +
                                                     '지불금액 : ' + value +
                                                     '교환율 : ' + rate +
                                                     'Gmov금액 : ' + res[0].input ;

                                      //구버전 - 신버전으로 변환 확정이 안된 상태
                                      /*
                                      let toMailOptions = {
                                        from : emailSender,
                                        to : userInfo.name + '<' + userInfo.email + '>',
                                        subject : '나눔코인 \'발급\' 알림 메일입니다',
                                        html : '관리로부터 나눔코인 <b>' + res[0].input + '원</b>이 발행되었습니다.<br>' +
                                               '<br>' + noreplyTail +'기타 문의사항은 Help desk로 문의해주세요.->'+deskemail,
                                        text : '관리자로부터 나눔코인' + res[0].input + '원이 발행되었습니다.'
                                      };
                                      */

                                      //신버전 - 미확정

                                      let toMailOptions = {
                                        from : emailSender,
                                        to : userInfo.name + '<' + userInfo.email + '>',
                                        subject : 'Gmov \'발급\' 알림 메일입니다.',
                                        html : mailHtml,
                                        text : mailText
                                      };

                                      smtpTransport.sendMail(toMailOptions, function(toEmailErr, toEmailRes){
                                        if(toEmailErr){
                                          console.log(toEmailErr);
                                        }else{
                                          console.log("message sent to " + userInfo.email + " : " + toEmailRes.message);
                                          //smtpTransport.close();
                                        }
                                      });

                                      //ICO 참가 완료
                                      eth.update({'txHash':ethList[ethIndex].txHash},{$set:{'complete':true}},(err,updateRes)=>{
                                        if(err){
                                          console.log("Error occured while reading mongoDB")
                                        }else{
                                          accountInfo.insertMany(res,(err,result)=>{
                                            if(err){
                                              console.log("Mongodb Error");
                                            }else{
                                              console.log("ICO Completed");
                                            }
                                          });
                                        }
                                      });
                                    }
                                  }
                                })
                              });
                            }
                          });
                        }
                      });
                    }
                  }
                }
              }
            });
          })
        }
      }
    });
  }
}
