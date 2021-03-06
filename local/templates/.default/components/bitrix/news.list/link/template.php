<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}
?>
<div class="news-list">
    <table>
        <tr>
            <th class="news-item" id="">ФИО</th>
            <th class="news-item" id="">Телефон</th>
            <th class="news-item" id="">Город</th>
            <th class="news-item" id="">Улица</th>
            <th class="news-item" id="">Дом</th>
            <th class="news-item" id="">Квартира</th>
        </tr>
      <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
          <tr>
              <td class="news-item" id="">
                <?= $arItem['PROPERTIES']['FULLNAME']['VALUE']; ?>
              </td>
              <td class="news-item" id="">
                <?= $arItem['PROPERTIES']['PHONE']['VALUE']; ?>
              </td>
              <td class="news-item" id="">
                <?= $arItem['PROPERTY_ADDRESS_PROPERTY_CITY_VALUE']; ?>
              </td>
              <td class="news-item" id="">
                <?= $arItem['PROPERTY_ADDRESS_PROPERTY_STREET_VALUE']; ?>
              </td>
              <td class="news-item" id="">
                <?= $arItem['PROPERTY_ADDRESS_PROPERTY_HOUSE_VALUE']; ?>
              </td>
              <td class="news-item" id="">
                <?= $arItem['PROPERTY_ADDRESS_PROPERTY_FLAT_VALUE']; ?>
              </td>

          </tr>
      <?php } ?>
    </table>
</div>