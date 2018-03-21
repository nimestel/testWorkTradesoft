<?php

$I = new AcceptanceTester($scenario);
$I->am('user'); // роль исполнителя
$I->wantTo('login to website'); // что проверяется
$I->lookForwardTo('access website features for logged-in users'); // что ожидается

//переход на главную страницу 
$I->amOnPage('/');
//переход на форму входа
$I->seeLink('Войти');
$I->click('#myModal a'); 

//не заполнять логин и пароль
$I->fillField('userlogin','');
$I->fillField('userpassword','');
$I->click('Войти', ['class' => 'btn--auth-submit']); 

//убедиться, что вход не выполнен
$I->expect('the form is not submitted');
$I->dontSee('Здравствуйте, ', '.auth-user__hello'); 