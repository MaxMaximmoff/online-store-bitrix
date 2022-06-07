<?php

namespace Ylab\Components;

use Bitrix\Main\Context;
use Bitrix\Main\Loader;
use Bitrix\Sale\Fuser;
use CBitrixComponent;
use Bitrix\Sale\Basket;
use Protobuf\Exception;

/**
 * Class PromoComponent
 * @package Ylab\Components
 * Компонент отображения списка элементов нашего ИБ
 */
class PromoComponent extends CBitrixComponent
{
  /** @var int $totalCoast Минимальная сумма в корзине */
  private $totalCoast = 2000;

  /**
   * Метод executeComponent
   *
   * @returm mixed/void
   * @throws Exception
   */
  public function executeComponent()
  {
    Loader::includeModule("catalog");

    $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

    $this->arResult['BASKET_ITEMS'] = $basket->getBasketItems();

    $this->arResult['IF_PROMO'] = $this->checkIfGivePromo($basket->getPrice());

    $this->includeComponentTemplate();
  }

  /**
   * Определяет может ли пользователь участвовать в акции
   * @param float $total
   * @returm bool
   */
  public function checkIfGivePromo(float $total): bool
  {
    return $total > $this->totalCoast;
  }
}
