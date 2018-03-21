<?php

class UserCest
{
    function signinFullCorrect(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $loginPage->login('testme', '123');
        $I->see('Здравствуйте, ', $loginPage::$helloform);
    }   
}

