<?php
namespace Pages;

class Product
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
     * Adding a product to the cart.
     *
     * @return array $itemData
     * @throws \Exception
     */
    public function addToCart()
    {
        $I = $this->tester;

        $I->waitForElementVisible('.product-item-details-pay-block');
        $length = $I->grabAttributeFrom('#product-length', 'value');
        $quantity = $I->grabAttributeFrom('#product-quantity', 'value');
        $width = $I->grabAttributeFrom('#product-width', 'value');
        $name = $I->grabTextFrom('h1');
        $itemPrice = $I->getNumberFromLink('.product-item-detail-price-current', 'price');
        $totalPrice = $I->getNumberFromLink('.js-total-sum', 'price');

        $I->assertEquals(str_replace(',', '.', $totalPrice), round(($length * $quantity * str_replace(',', '.', $width) * $itemPrice), 2),
            'wrong total amount');

        $I->waitAndClick('//a[.="Купить"]', "buy button");
        $this->goToCartFromPopUp();

        $itemData = array('width' => $width, 'totalPrice' => $totalPrice, 'name' => $name);

        return $itemData;
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

        $I->waitAndFill('#product-length', 'length', $length);
        $length = $I->grabTextFrom('#product-length');

        return $length;
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

        $I->waitAndFill('#product-quantity', 'quantity', $quantity);
        $quantity = $I->grabTextFrom('#product-quantity');

        return $quantity;
    }

    /**
     * Оформить заказ.
     *
     * @throws \Exception
     */
    public function goToCartFromPopUp()
    {
        $I = $this->tester;

        $I->waitAndClick('//a[.="Оформить заказ"]', 'go to cart', true);
        $I->waitForElementVisible('//h1[.="Моя корзина"]');
    }
}