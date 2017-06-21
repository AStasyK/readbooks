<?php
use yii\helpers\Url as Url;

class AboutCest
{
    public function ensureThatAboutWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/main/about'));
        $I->see('About', 'h1');
    }
}
