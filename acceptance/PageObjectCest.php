<?php

class UserCest
{

    //вход с действительными логином и паролем
    function signInWithFullCorrect(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '123');
        $I->seeElement($loginPage::$helloform);
        $I->see('Здравствуйте');
        $loginPage->logout();    }   

    //вход с пустыми логином и паролем
    function signInWithEmptyFields(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('', '');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
    }   
 
    //вход с действительным логином и пустым паролем
    function signInWithEmptyPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
    }   
    
    //вход с действительным логином и недействительным паролем
    function signInWithCorrectLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '111');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с недействительным логином и действительным паролем
    function signInWithBadLoginCorrectPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '123');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }   
  
    //вход с недействительными логином и паролем
    function signInWithBadLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '111');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с неликвидными символами в поле ввода логина
    function signInWithBadSymbolsInLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('مشوه', '123');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }

    //вход с неликвидными символами в поле ввода пароля
    function signInWithBadSymbolsInPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', 'مشوه');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с логином в верхнем регистре
    function signInWithUpperCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('TESTME', '123');
        $I->seeElement($loginPage::$helloform);
        $I->see('Здравствуйте');
    } 
 
    //вход с логином с буквами в разном регистре
    function signInWithDifferentCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('tEsTmE', '123');
        $I->seeElement($loginPage::$helloform);
        $I->see('Здравствуйте');
    } 
 
    //вход с паролем с буквами в разном регистре
    function signInWithDifferentCasePassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('justlogin123', 'itSpass123');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError);
    } 
     
    //проверка, что значение пароля не копируется
    function signInWithHiddenPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        $I->wantTo('copy password'); 
        $pass = $I->grabTextFrom("//input[@id = 'userpassword']");
        echo($pass);
        $I->dontSee('123');
    }   
 
    //проверка, что в поле ввода пароля звездочки
    function signInWithEncryptedPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        // однозначное указание элемента поля ввода пароля с типом "password"
        $I->grabTextFrom("//input[@id='userpassword'][contains(@type, 'password')]"); 
    }  
 
    //вход с вводом превышенного лимита символов в поле логин
    function signInWithOverLimitSymbolsInLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('123456789-123456789-123456789-123456789-123456789-123456789-12345', '123');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError);
    }

    //вход с вводом превышенного лимита символов в поле пароль
    function signInWithOverLimitSymbolsInPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {        
        $loginPage->login('testme', '123456789-123456789-123456789-123456789-123456789-123456789-12345');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError);
    }
	 
    //вход с пробелами в начале или конце логина 
    function signInWithSpaceAtBeginAndEndLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {    
        $loginPage->fillFieldsLoginPassword('testme  ', '123');
        $I->click($loginPage::$submitButton);      
        $I->seeElement($loginPage::$helloform);
        $I->see('Здравствуйте');
   
    }  

    //вход с пробелами в начале или конце пароля
    function signInWithSpaceAtBeginAndEndPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '  123');
        $I->click($loginPage::$submitButton);
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError);
    }
    

    //вход с пробелами в середине логина 
    function signInWithSpaceInMiddleLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test me', '123');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }

    //вход с пробелами в середине пароля
    function signInWithSpaceInMiddlePassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '1 23');
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$loginError); 
    }  
    
    //тест с множественными неудачными попытками входа отключен, чтобы остальные тесты не падали
    /*
    function signInWithMultipleFailedLoginAttempts(AcceptanceTester $I, \Page\Login $loginPage)
    {

        $I->amOnPage($loginPage::$URL);
        $I->click($loginPage::$loginform);

        for ($j = 1; $j <= 4; $j++)
        {
     //       $loginPage->tryLogIn('123', '123'); 
        }
        
        $I->dontSeeElement($loginPage::$helloform);
        $I->dontSee('Здравствуйте');
        $I->see($loginPage::$manyAttemptsLoginError);  
    }   
    */
}

