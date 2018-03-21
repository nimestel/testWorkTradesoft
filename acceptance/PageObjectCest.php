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

    function signInOverLimitSymbolsInLoginPassword(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('123456789-123456789-123456789-123456789-123456789-123456789-12345', '123');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);

        $loginPage->login('testme', '123456789-123456789-123456789-123456789-123456789-123456789-12345');
        $I->dontSee('Здравствуйте, ', $loginPage::$helloform);
        $I->see($loginPage::$loginError);
    }
    
}

