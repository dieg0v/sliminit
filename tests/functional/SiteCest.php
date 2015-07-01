<?php

use \FunctionalTester;

class SiteCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    //tests
    public function siteNav(FunctionalTester $I)
    {
		$I->am('a guest');
		$I->wantTo('Navigate on site');

		$I->amOnPage('/');
		$I->seeCurrentUrlEquals('/');
		$I->see('sliminit');

    }

    public function site404(FunctionalTester $I)
    {
		$I->am('a guest');
		$I->wantTo('Force 404 on site');

		$I->amOnPage('/no-exits-page');
		$I->seeCurrentUrlEquals('/no-exits-page');
		$I->see('404');
    }

}

