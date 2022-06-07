<?php

namespace Mylab\Components;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\LoaderException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Ylab\Helpers;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use CBitrixComponent;
use Bitrix\Sale\Basket;
use Bitrix\Currency;


/**
 * Class GiftComponent
 * @package Mylab\Components
 * Компонент для добавления подарка в корзину
 */
class GiftComponent extends CBitrixComponent
{

  /* @var float $minPrice Цена для начисления подарка
   * @var string $elementCode Символьный код товара
   * @var string $iblockCode Символьный код инфоблока
   *
   */
  private $minPrice = 500;
  private $minGiftedQuantity = 3;
  private $elementCode = "New-Era-115";
  private $iblockCode = "clothes";
  private $moduleName = "catalog";


  /**
   * Метод executeComponent
   *
   * @returm mixed/void
   * @throws ArgumentException
   * @throws LoaderException
   * @throws ObjectPropertyException
   * @throws SystemException
   */
  public function executeComponent()
  {
    Loader::includeModule($this->moduleName);

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    $this->arResult['BASKET_ITEMS'] = $basket->getBasketItems();

    $this->arResult['IF_GIFT'] = $this->checkIfGiftMastHave();

    $elementCode = $this->elementCode;
    $iblockCode = $this->iblockCode;

    $productId = Helpers::getElementIdByCode($elementCode, $iblockCode);

    // Добавляем подарок в корзину, если выполняется требуемое условие
    if ($this->arResult['IF_GIFT'] && !$this->checkIfGiftInBasket($productId)) {
      $quantity = 1;
      $this->addItemToBasket($productId, $quantity);
    } // Удаляем подарок из корзины, если не выполняется требуемое условие
    else if (!$this->arResult['IF_GIFT'] && $this->checkIfGiftInBasket($productId)) {
      $this->deleteItemFromBasket($productId);
    }

//  Обработка формы
    if (isset($_POST['quantity'])) {
//       Если нет ошибок
      if (true) {
        $this->deleteItemFromBasket($productId);
        $this->addItemToBasket($productId, $_POST['quantity']);
        $_SESSION['flash'] = 'Запись добавлена';
        // обновление страницы
        header("Location: " . $_SERVER['REQUEST_URI']);
      }
    } else {
      // Обычный запрос
      if (!empty($_SESSION['flash'])) {
//        print $_SESSION['flash'];
        unset($_SESSION['flash']);
      }
    }

    $this->includeComponentTemplate();
  }

  /**
   * Определяет есть ли в корзине минимум 3 товара с ценой более 500р
   * @return bool
   * @throws ArgumentException
   * @throws LoaderException
   * @throws SystemException
   */
  public function checkIfGiftMastHave(): bool
  {
    Loader::includeModule($this->moduleName);

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    $point = 0;
    $basketItems = $basket->getBasketItems();

    foreach ($basketItems as $basketItem) {
      if ($basketItem->getPrice() > $this->minPrice) {
        for ($i = 0; $i < $basketItem->getQuantity(); $i++) {
          $point++;
          if ($point >= $this->minGiftedQuantity) {
            return true;
          }
        }
      }
    }

    return false;
  }

  /**
   * Добавляет товар в корзину в указанном к-ве
   * @param int $productId ID товара
   * @param int $quantity К-во едениц товара
   * @return void
   * @throws ArgumentException
   * @throws LoaderException
   * @throws SystemException
   */
  public function addItemToBasket(int $productId, int $quantity): void
  {
    Loader::includeModule($this->moduleName);

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    if ($item = $basket->getExistsItem($this->moduleName, $productId)) {
      $item->setField('QUANTITY', $item->getQuantity() + $quantity);
    } else {
      $item = $basket->createItem($this->moduleName, $productId);
      $item->setFields(array(
        'QUANTITY' => $quantity,
        'CURRENCY' => Currency\CurrencyManager::getBaseCurrency(),
        'LID' => Context::getCurrent()->getSite(),
        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
      ));
    }
    $basket->save();
  }

  /**
   * Удаляет выбранный товар из корзины
   * @param int $productId ID товара
   * @return void
   * @throws ArgumentException
   * @throws LoaderException
   * @throws SystemException
   */
  public function deleteItemFromBasket(int $productId): void
  {
    Loader::includeModule($this->moduleName);

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    if ($item = $basket->getExistsItem('catalog', $productId)) {
      $item->delete();
    }
    $basket->save();
  }

  /**
   * Определяет есть ли уже подарок в корзине
   * @param int $productId
   * @return bool
   * @throws ArgumentException
   * @throws LoaderException
   * @throws SystemException
   */
  public function checkIfGiftInBasket(int $productId): bool
  {
    Loader::includeModule($this->moduleName);

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    if ($basket->getExistsItem($this->moduleName, $productId)) {
      return true;
    }

    return false;
  }

}

