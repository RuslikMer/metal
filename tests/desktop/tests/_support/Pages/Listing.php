<?php
namespace Pages;

class Listing
{
    // include url of current page
    public static $URL = '';

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
     * Выбрать категорию.
     *
     * @param string $categoryNum
     * @throws \Exception
     */
    public function selectCategory($categoryNum)
    {
        $I = $this->tester;

        $I->waitForElementVisible('//div[contains(@class, "category-card-row")]');
        if (is_null($categoryNum)) {
            $categoriesCount = $I->getNumberOfElements('//div[contains(@class, "category-card-row")]/div');
            $categoryNum = mt_rand(1, $categoriesCount);
        }

        $sectionsPath = '//div[contains(@class, "category-card-row")]/div'.'['.$categoryNum.']';
        $I->waitAndClick($sectionsPath, 'select category');
        $I->waitForElementNotVisible($sectionsPath);
    }

    /**
     * Выбрать товар.
     *
     * @param int $itemNum
     * @throws \Exception
     */
    public function goToProduct($itemNum)
    {
        $I = $this->tester;

        if (is_null($itemNum)) {
            $itemNum = $this->getRandomItemNumber('.product_card');
        }

        $I->lookForwardTo('go to product ' . $itemNum);
        $I->waitAndClick('//div[contains(@class, "product_card")][' . $itemNum . ']//div[@class="product-name"]/a', 'go to product ' . $itemNum);
        $I->waitForElementVisible('span.detail-product-code');
    }

    /**
     * Случайный номер товара.
     *
     * @param string $itemXpath
     * @return int $itemNum
     * @throws \Exception
     */
    public function getRandomItemNumber($itemXpath)
    {
        $I = $this->tester;

        $I->waitForElementVisible($itemXpath);
        $items = $I->getNumberOfElements($itemXpath, 'products in grid');
        $I->assertNotEquals($items, 0, 'No available products');
        $itemNum = mt_rand(1, $items);
        if ($itemNum > 15) {
            $itemNum = 15;
        }

        return $itemNum;
    }
}