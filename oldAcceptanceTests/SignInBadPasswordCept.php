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

//ввести верный логин и неверный пароль
$I->fillField('userlogin','testme');
$I->fillField('userpassword','111');
$I->click('Войти', ['class' => 'btn--auth-submit']); 

//увидеть ошибку о неправильном логине и пароле
$I->see('Ошибка: указанные Вами логин и пароль в базе данных не найдены.'); 