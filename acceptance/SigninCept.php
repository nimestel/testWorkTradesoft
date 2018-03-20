<?php
$I = new AcceptanceTester($scenario);
$I->am('user'); // actor's role
$I->wantTo('login to website'); // feature to test
$I->lookForwardTo('access website features for logged-in users'); // result to achieve
$I->amOnPage('/');
$I->click('Войти');
$I->fillField('userlogin','testme');
$I->fillField('userpassword','123');
$I->click('Войти');