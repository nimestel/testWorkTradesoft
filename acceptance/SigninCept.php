<?php
$I = new AcceptanceTester($scenario);
$I->am('user'); // роль исполнителя
$I->wantTo('login to website'); // что проверяется
$I->lookForwardTo('access website features for logged-in users'); // ожидаемый результат
$I->amOnPage('/');
//переход на форму входа
$I->seeLink('Войти');
$I->click('#myModal a'); 
//ввод логина и пароля
$I->fillField('userlogin','testme');
$I->fillField('userpassword','123');
$I->click('Войти', ['class' => 'btn--auth-submit']); // нажать на кнопку Войти
$I->see('Здравствуйте, ', '.auth-user__hello'); //увидеть приветствие пользователя