<?php



class UserControllerCest
{
    protected $user;

    public function __construct(\AcceptanceTester $I) 
    {
        $this->user = $I;
    }
    public function login($userlogin, $userpassword) 
    {
        $this->user->amOnPage(LoginPageCest::$URL);
        $this->user->click(LoginPageCest::$loginform);
        $this->user->fillField(LoginPageCest::$userloginField, $username);
        $this->user->fillField(LoginPageCest::$userpasswordField, $password);
        $this->user->click(LoginPageCest::$submitButton);
    }

    public function logout() 
    {
        $this->user->click("Выйти");
    }
}

        $I = new AcceptanceTester($scenario); 
        $U = new UserControllerCest($I); 
        $I->wantTo('login to website'); 
        $U->login('testme', '123'); 
        $I->see('Здравствуйте, ', LoginPageCest::$helloform);
        $U->logout(); 
        $I->see('Войти');

