<?php
//данный тест проверяет корректный пересчет суммы корзины
// при изменении парметров длины и количества
// реализованный методы не адаптированы под все сценарии, так как обговаривался только один тест кейс
$I = new AcceptanceTester($scenario);
$I->am("not authorized user");
$I->openHomePage();
$I->acceptRegion();
$I->selectMenuTab('Кровля');
$I->selectCategory(1);
$I->goToProductFromListing(1);
$I->setLength(2);
$I->setQuantity(10);
$I->addToCart();
$I->setQuantityInCart(11);
$I->setLengthInCart(5);
$I->totalAmountCalculation();