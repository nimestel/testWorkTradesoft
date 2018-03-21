<?php
namespace Page;

class Login
{
    public static $URL = 'https://xn----8sbbddoe5esabkbhs.xn--p1ai/';
   // Эти свойства определяют отображение пользовательского интерфейса для страницы регистрации
    public static $userloginField = 'userlogin';
    public static $userpasswordField = 'userpassword';
    public static $loginform = "#myModal a";
    public static $submitButton = "//input[@type='submit'][contains(@value, 'Войти')]";
    public static $helloform = ".auth-user__hello";
    public static $closeback = "//button[@type='button'][contains(@class, 'close ico-auth-close')]"; //gotohell
    public static $logout = '//ul[@class="user-menu"]/li/a[@href="/?logout"]';
    public static $loginError = 'Ошибка: указанные Вами логин и пароль в базе данных не найдены.';
    protected $user;

    public function __construct(\AcceptanceTester $I) 
    {
        $this->user = $I;
    }
    
    public function login($userlogin, $userpassword) 
    {
        $I = $this->user;        
        $I->wantTo('login to website'); 
        $I->lookForwardTo('access website features for logged-in users'); 
        $I->amOnPage(self::$URL);
        $I->click(self::$loginform);
        $I->fillField(self::$userloginField, $userlogin);
        $I->fillField(self::$userpasswordField,$userpassword);
        $I->click(self::$submitButton);        
    }

    public function logout() 
    {
        $I = $this->user;
        $I->click(self::$logout);
    }


}
