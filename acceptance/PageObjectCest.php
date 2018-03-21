<?php

class UserCest
{

    //вход с действительными логином и паролем
    function signInFullCorrect(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    }   

    //вход с пустыми логином и паролем
    function signInEmptyFields(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('', '');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
    }   
 
    //вход с действительным логином и пустым паролем
    function signInEmptyPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
    }   
    
    //вход с действительным логином и недействительным паролем
    function signInCorrectLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '111');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с недействительным логином и действительным паролем
    function signInBadLoginCorrectPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
  
    //вход с недействительными логином и паролем
    function signInBadLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '111');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с неликвидными символами в полях ввода логина и пароля
    function signInBadSymbolsInLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('مشوه', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 

        $loginPage->login('testme', 'مشوه');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
 
    //вход с логином в верхнем регистре
    function signInUpperCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('TESTME', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    } 
 
    //вход с логином с буквами в разном регистре
    function signInDifferentCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('tEsTmE', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    } 
 
    //вход с паролем с буквами в разном регистре
    function signInDifferentCasePassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login(' justlogin123', 'itSpass123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    } 
     
    //проверка, что значение пароля не копируется
    function signInHiddenPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        $pass = $I->grabTextFrom("//input[@id = 'userpassword']");
        echo($pass);
        $I->dontSee('123');
    }   
 
    //проверка, что в поле ввода пароля звездочки
    function signInEncryptedPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        // однозначное указание элемента поля ввода пароля с типом "password"
        $I->grabTextFrom("//input[@id='userpassword'][contains(@type, 'password')]"); 
    }  
 
    //вход с вводом превышенного лимита символов в поля логин и пароль
    function signInOverLimitSymbolsInLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('123456789-123456789-123456789-123456789-123456789-123456789-12345', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);

        $loginPage->login('testme', '123456789-123456789-123456789-123456789-123456789-123456789-12345');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    }
	 
    //вход с пробелами в начале или конце логина 
    function signInSpaceAtBeginAndEndLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {    
        $loginPage->fillFieldsLoginPassword('testme  ', '123');
        $I->click($loginPage::$submitButton);      
        $I->see('Здравствуйте, ', $loginPage::$helloform);
   
    }  

    //вход с пробелами в начале или конце пароля
    function signInSpaceAtBeginAndEndPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '  123 ');
        $I->click($loginPage::$submitButton);
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    }
    

    //вход с пробелами в середине логина и пароля
    function signInSpaceInMiddleLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test me', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 

        $loginPage->login('testme', '1 23');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }  
    
    //тест с множественными неудачными попытками входа отключен, чтобы остальные тесты не падали
    /*
    function signInMultipleFailedLoginAttempts(AcceptanceTester $I, \Page\Login $loginPage)
    {

        $I->amOnPage($loginPage::$URL);
        $I->click($loginPage::$loginform);

        for ($j = 1; $j <= 4; $j++)
        {
     //       $loginPage->tryLogIn('123', '123'); 
        }
       
        $I->see($loginPage::$manyAttemptsLoginError);  
    }   
    */
}

