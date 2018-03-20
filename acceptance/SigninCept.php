<?php
$I = new AcceptanceTester($scenario);
$I->am('user'); // роль исполнителя
$I->wantTo('login to website'); // что проверяется
$I->lookForwardTo('access website features for logged-in users'); // ожидаемый результат
$I->amOnPage('/');
//вызов формы входа
$I->click('#myModal a'); 
//ввод логина и пароля
//$I->submitForm('loginform', ['userlogin' => 'testme', 'userpassword' => '123']);
$I->fillField('userlogin','testme');
$I->fillField('userpassword','123');
$I->click('Войти', ['class' => 'btn--auth-submit']); // нажать на кнопку Войти
$I->See('Здравствуйте, ');