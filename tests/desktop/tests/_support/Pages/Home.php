<?php
namespace Pages;

class Home
{
    // include url of current page
    public static $URL = '/';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    /**
     * Открыть домашнюю страницу.
     *
     * @throws \Exception
     */
    public function open() {
        $I = $this->tester;

        $I->amOnPage('/');
        $this->confirmProcessingPersonalData();
    }

    /**
     * Подтверждение куки.
     *
     * @throws \Exception
     */
    public function confirmProcessingPersonalData()
    {
        $I = $this->tester;

        $I->waitForElementVisible('.cookies-popup');
        $I->waitAndClick('.cookies-popup__right', 'confirm button', true);
        $I->waitForElementNotVisible('.cookies-popup');
    }

    /**
     * Подтвердить регион.
     *
     * @throws \Exception
     */
    public function acceptRegion()
    {
        $I = $this->tester;

        $I->waitAndClick('//*[@id="header"]//a[.="Да, верно"]', 'accept');
        $I->waitForElementNotVisible('//*[@id="header"]//a[.="Да, верно"]');
    }

    /**
     * Выбор таба меню.
     *
     * @param string $tabName
     * @throws \Exception
     */
    public function selectMenuTab($tabName)
    {
        $I = $this->tester;

        $I->waitAndClick('//span[.="'.$tabName.'"]', 'select menu tab');
        $I->waitForElementVisible('//h1[contains(.,"'.$tabName.'")]');
    }


    /**
     * Получить текущий регион.
     *
     * @return string $region
     * @throws \Exception
     */
    public function getCurrentRegion()
    {
        $I = $this->tester;

        $region = $I->grabTextFrom('.regions-link');

        return $region;
    }
}