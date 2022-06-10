<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

use Bitrix\Main\Localization\Loc;

?>

<div class="list">
    <b><?= Loc::getMessage('MYLAB.GIFT.ITEMS') ?></b><br/><br/>
  <?php foreach ($arResult['BASKET_ITEMS'] as $basketItem) { ?>
      <div>
          <p><?= $basketItem->getField('NAME') . ' - ' . $basketItem->getField('PRICE') . ' руб ' . ' - ' . $basketItem->getQuantity() . ' шт ' . '<br />' ?></p>
      </div>
      <hr>
  <?php } ?>
</div>

<div>
    <b><?= Loc::getMessage('MYLAB.GIFT.IF_YES') ?></b>
  <?php if ($arResult['IF_GIFT']) { ?>
    <?= Loc::getMessage('MYLAB.GIFT.YES') ?>
  <?php } else { ?>
    <?= Loc::getMessage('MYLAB.GIFT.NO') ?>
      <br/>
  <?php } ?>
    <br/>
    <hr>
</div>


<div class="basket-checkout-block">
    <form action="" method="POST">
        <div><label for="">Количество подарков: <input type="number" name="quantity" value="0"></label></div>
<!--        <div><input type="submit" class="btn btn-lg btn-primary" name="getGifts" value="Хочу столько"></div>-->
        <div><button type="submit" class="btn btn-lg btn-primary" name="getGifts" value="yes"><?= "Хочу столько" ?></div>
    </form>
</div>




