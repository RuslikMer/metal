<?php
namespace Pages;

class Cart
{
    // include url of current page
    public static $URL = '/shopping-bag/';

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
     * Проверка стоимости товаров.
     *
     * @return int $totalSum
     * @throws \Exception
     */
    public function totalAmountCalculation()
    {
        $I = $this->tester;

        $region = $I->getCurrentRegion();
        $length = $I->grabAttributeFrom(['name' => 'length[]'], 'value');
        $quantity = $I->grabAttributeFrom(['name' => 'quantity[]'], 'value');
        $width = $I->grabTextFrom('span.property-width');
        $itemPrice = $I->getNumberFromLink('span.price-calc__price', 'price');
        $itemLink = $I->grabAttributeFrom('//div[@class="product-name"]//a[@href]', 'href');
        $subSum = $I->getNumberFromLink('//div[@class="cart-product-total"]//li[contains(.,"Стоимость товара")]/span[2]', 'price');
        $package = $I->getNumberFromLink('//div[@class="cart-product-total"]//li[contains(.,"Упаковка")]/span[2]', 'package');
        $totalSum = $I->getNumberFromLink('#basket-total-price', 'total');
        $I->assertEquals(str_replace(',', '.', $subSum), round(($length * $quantity * str_replace(',', '.', $width) * $itemPrice), 2),
            'wrong subtotal amount');
        $I->assertEquals(str_replace(',', '.', $totalSum), str_replace(',', '.', $subSum) + $package,
            'некорретная итоговая сумма для товара '.$itemLink.', регион: '.$region.', количество листов: '.$quantity.', длина, м: '.$length);

        return $totalSum;
    }

    /**
     * Задать длину.
     *
     * @param string $length
     * @return string $length
     * @throws \Exception
     */
    public function setLength($length)
    {
        $I = $this->tester;

        $I->waitAndFill(['name' => 'length[]'], 'length', $length);
        $I->waitForElementVisible('//input[@name="length[]"][@value="'.$length.'"]');
    }

    /**
     * Задать количество.
     *
     * @param string $quantity
     * @return string $quantity
     * @throws \Exception
     */
    public function setQuantity($quantity)
    {
        $I = $this->tester;

        $I->waitAndFill(['name' => 'quantity[]'], 'quantity', $quantity);
        $I->waitForElementVisible('//input[@name="quantity[]"][@value="'.$quantity.'"]');
    }
}