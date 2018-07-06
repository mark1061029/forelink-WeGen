const express = require('express');

const router = express.Router();

router.use('/',require('./main'));
router.use('/',require('./address'));
router.use('/',require('./addressDetail'));
router.use('/',require('./addressUpdate'));
router.use('/',require('./delete'));
router.use('/',require('./deleteConfirm'));
router.use('/',require('./email-verification'));
//router.use('/',require('./findId'));
router.use('/',require('./findPwd'));
router.use('/',require('./icoParticipate'));
router.use('/',require('./issue'));
router.use('/',require('./login'));
router.use('/',require('./logout'));
router.use('/',require('./permission'));
router.use('/',require('./permissions'));
router.use('/',require('./sendAsset'));
router.use('/',require('./ledger'));
router.use('/',require('./signup'));
router.use('/',require('./privacyPolicy'));
router.use('/',require('./termsAndConditions'));
router.use('/',require('./configure'));
router.use('/',require('./otp-verification'));
router.use('/',require('./myWallet'));
router.use('/',require('./icoLedger'));
//router.use('/',require('./getinfo'));
router.use('/',require('./adminLedger'));

router.use('/',require('./reserDays'));
router.use('/',require('./reserReport'));
router.use('/',require('./reserRecom'));
router.use('/',require('./reserSMS'));
router.use('/',require('./reserTotal'));
router.use('/',require('./reserva'));
router.use('/',require('./ico'));

router.use('/',require('./ethereumTest'));

router.use('/',require('./PageNotFound'));


module.exports = router;
