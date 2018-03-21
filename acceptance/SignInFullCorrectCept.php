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

//ввести логин и пароль
$I->fillField('userlogin','testme');
$I->fillField('userpassword','123');
$I->click('Войти', ['class' => 'btn--auth-submit']); 

//увидеть приветствие пользователя
$I->see('Здравствуйте, Клиент', '.auth-user__hello'); 