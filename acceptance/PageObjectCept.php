<?php
use Page\Login as LoginPage;

        $I = new AcceptanceTester($scenario);         
        $I->wantTo('login to website');
        $page = new LoginPage($I);
        $page->login('testme', '123'); 
        $I->see('Здравствуйте, ', $page::$helloform);

    