<?php

class UserCest
{

    function signInFullCorrect(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    }   

    function signInEmptyFields(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('', '');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
    }   
 
    function signInEmptyPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
    }   
 
    function signInCorrectLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '111');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
 
    function signInBadLoginCorrectPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   
 
    function signInBadLoginBadPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test', '111');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   

    function signInBadSymbolsInLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('مشوه', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 

        $loginPage->login('testme', 'مشوه');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }   

    function signInUpperCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('TESTME', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    } 

    function signInDifferentCaseLogin(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('tEsTmE', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    } 

    function signInDifferentCasePassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login(' justlogin123', 'itSpass123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    } 
    
    function signInHiddenPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        $pass = $I->grabTextFrom("//input[@id = 'userpassword']");
        echo($pass);
        //значение пароля не скопировалось
        $I->dontSee('123');
    }   

    function signInEncryptedPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '123');
        // однозначное указание элемента поля ввода пароля с типом "password"
        $I->grabTextFrom("//input[@id='userpassword'][contains(@type, 'password')]"); 
    }  

    function signInOverLimitSymbolsInLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('123456789-123456789-123456789-123456789-123456789-123456789-12345', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);

        $loginPage->login('testme', '123456789-123456789-123456789-123456789-123456789-123456789-12345');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    }
	
    function signInSpaceAtBeginAndEndLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->fillFieldsLoginPassword('testme', '  123 ');
        $I->click($loginPage::$userpasswordField);
        $I->click($loginPage::$submitButton);
        $I->see('Здравствуйте, ', $loginPage::$helloform);
        

        $loginPage->fillFieldsLoginPassword('testme     ', '123');
        $I->click($loginPage::$userpasswordField);
        $I->click($loginPage::$submitButton);        
        $I->see('Здравствуйте, ', $loginPage::$helloform);    
    }  

    function signInSpaceInMiddleLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('test me', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 

        $loginPage->login('testme', '1 23');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError); 
    }  
    
    //отключен, чтобы остальные тесты не падали
    function signInMultipleFailedLoginAttempts(AcceptanceTester $I, \Page\Login $loginPage)
    {

        $I->amOnPage($loginPage::$URL);
     //   $I->click($loginPage::$loginform);

        for ($j = 1; $j <= 4; $j++)
        {
     //       $loginPage->tryLogIn('123', '123'); 
        }
       
        $I->see($loginPage::$manyAttemptsLoginError);  
    }   

}

