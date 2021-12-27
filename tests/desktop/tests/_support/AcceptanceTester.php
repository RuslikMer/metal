<?php

use Pages\Cart as CartPage;
use Pages\Home as HomePage;
use Pages\Listing as ListingPage;
use Pages\Product as ProductPage;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * Откртыь домашнюю страницу.
     *
     * @throws \Exception
     */
    public function openHomePage()
    {
        $I = $this;

        $homePage = new HomePage($I);
        $homePage->open();
    }

    /**
     * Подтвердить регион.
     *
     * @throws \Exception
     */
    public function acceptRegion()
    {
        $I = $this;

        $homePage = new HomePage($I);
        $homePage->acceptRegion();
    }

    /**
     * Выбор таба меню.
     *
     * @param string $tabName
     * @throws \Exception
     */
    public function selectMenuTab($tabName)
    {
        $I = $this;

        $homePage = new HomePage($I);
        $homePage->selectMenuTab($tabName);
    }


    /**
     * Получить текущий регион.
     *
     * @return string $region
     * @throws \Exception
     */
    public function getCurrentRegion()
    {
        $I = $this;

        $homePage = new HomePage($I);
        return $homePage->getCurrentRegion();
    }

    /**
     * Переход на карточку товара.
     *
     * @param int $itemNum
     * @throws \Exception
     */
    public function goToProductFromListing($itemNum = null)
    {
        $I = $this;

        $listingPage = new ListingPage($I);
        $listingPage->goToProduct($itemNum);
    }

    /**
     * Выбрать категорию.
     *
     * @param string $categoryNum
     * @throws \Exception
     */
    public function selectCategory($categoryNum)
    {
        $I = $this;

        $listingPage = new ListingPage($I);
        $listingPage->selectCategory($categoryNum);
    }

    /**
     * Прлучить случайный товар.
     *
     * @param string $itemXpath
     * @return int $itemNum
     * @throws \Exception
     */
    public function getRandomItemNumber($itemXpath)
    {
        $I = $this;

        $listingPage = new ListingPage($I);
        return $listingPage->getRandomItemNumber($itemXpath);
    }

    /**
     * Добавить товар в корзину.
     *
     * @return array $itemData
     * @throws \Exception
     */
    public function addToCart()
    {
        $I = $this;

        $productPage = new ProductPage($I);
        return $productPage->addToCart();
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
        $I = $this;

        $productPage = new ProductPage($I);
        return $productPage->setLength($length);
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
        $I = $this;

        $productPage = new ProductPage($I);
        return $productPage->setQuantity($quantity);
    }

    /**
     * Проверка стоимости товаров.
     *
     * @return int $totalSum
     * @throws \Exception
     */
    public function totalAmountCalculation()
    {
        $I = $this;

        $cartPage = new CartPage($I);
        return $cartPage->totalAmountCalculation();
    }

    /**
     * Задать длину.
     *
     * @param string $length
     * @return string $length
     * @throws \Exception
     */
    public function setLengthInCart($length)
    {
        $I = $this;

        $cartPage = new CartPage($I);
        return $cartPage->setLength($length);
    }

    /**
     * Задать количество.
     *
     * @param string $quantity
     * @return string $quantity
     * @throws \Exception
     */
    public function setQuantityInCart($quantity)
    {
        $I = $this;

        $cartPage = new CartPage($I);
        return $cartPage->setQuantity($quantity);
    }

    /**
     * Getting the current address.
     */
    public function getCurrentUrlJS()
    {
        return $this->executeJS("return location.href");
    }

    /**
     * Click on an element with Js.
     *
     * @param string $path path to element
     */
    public function clickJs($path)
    {
        $I = $this;

        $I->executeJS($path.'.click();');
    }

    /**
     * Clear cookies.
     *
     * @throws \Exception
     */
    public function clearCookies()
    {
        $I = $this;

        $I->executeInSelenium(function(\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
            $webdriver->manage()->deleteAllCookies();
        });
    }

    /**
     * Wait page.
     *
     * @throws \Exception
     */
    public function waitPage()
    {
        $I = $this;

        $I->executeInSelenium(function(\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
            $webdriver->wait()->until($webdriver->executeScript('return document.readyState'));
        });
    }

    /**
     * Implicitly waiting for an element using Js.
     *
     * @param string $path
     * @throws \Exception
     */
    public function waitUntilJs($path)
    {
        $I = $this;

        $I->executeJS('function pollDOM () {
            if ('.$path.' == null) {
                setTimeout(pollDOM, 1000);
            }
        }
        
        pollDOM();');
    }

    /**
     * Fill input field with Js.
     *
     * @param string $path
     * @param string $text
     * @throws \Exception
     */
    public function fillFieldJS($path, $text)
    {
        $I = $this;

        $I->executeJS($path.'.value = "'.$text.'"');
    }

    /**
     * Filling in the input field.
     *
     * @param mixed $link Entry field
     * @param string $description Field Description
     * @param string $data Input data
     * @param null $noScroll Disable scrolling
     * @throws \Exception
     */
    public function waitAndFill($link, $description, $data, $noScroll = null)
    {
        $I = $this;

        $I->waitAndClick($link, $description, $noScroll);
        $I->fillField($link, $data);
        $I->wait(SHORT_WAIT_TIME);
    }

    /**
     * Getting a number from an element specified by a link and description.
     *
     * @param mixed $link
     * @param string $linkDescription
     * @return string
     * @throws \Exception
     */
    public function getNumberFromLink($link, $linkDescription)
    {
        $I = $this;

        if (!is_null($linkDescription)) {
            echo("get number from " . $linkDescription);
        }

        $numberFromLink = preg_replace("/[^0-9.,]/", "", $I->grabTextFrom($link));
        if (empty($numberFromLink)) {
            $numberFromLink = 0;
        }

        echo("the number from link is " . $numberFromLink);
        return $numberFromLink;
    }

    /**
     * Clicking on an item includes waiting for an item and displaying its description.
     *
     * @param string $path element reference
     * @param string $linkDescription element description
     * @param string $noScroll disable scrolling to the element
     * @throws \Exception
     */
    public function waitAndClick($path, $linkDescription, $noScroll = null)
    {
        $I = $this;

        echo("trying to click " . $linkDescription);

        try {
            $I->waitForElementVisible($path, 30);
        } catch (\Exception $ex) {
            Throw new \Exception('Cannot wait for ' . $linkDescription . ' within ' . ELEMENT_WAIT_TIME . ' seconds');
        }

        try {
            $I->waitForElementClickable($path, 30);
        } catch (\Exception $ex) {
            Throw new \Exception('Cannot wait for ' . $linkDescription . ' within ' . ELEMENT_WAIT_TIME . ' seconds');
        }

        if (is_null($noScroll)) {
            try {
                $I->scrollTo($path, 0, -100);
            } catch ( \Exception $ex) {
                Throw new \Exception('Cannot scroll to ' . $linkDescription);
            }
        }

        $I->click($path, null);
    }

    /**
     * Get the number of items defined by link and description.
     *
     * @param mixed $path element reference
     * @param string $linkDescription description of elements (optional)
     * @return int $numberOfElements number of elements found
     * @throws \Exception
     */
    public function getNumberOfElements($path, $linkDescription = null)
    {
        $I = $this;

        if (!is_null($linkDescription)) {
            echo("get number of " . $linkDescription . " from page");
        }

        $elementsArray = $I->grabMultiple($path);
        codecept_debug("grabbed array");
        codecept_debug($elementsArray);
        $numberOfElements = count($elementsArray);
        codecept_debug('Number of ' . $linkDescription . ' is ' . $numberOfElements);

        return $numberOfElements;
    }
}
