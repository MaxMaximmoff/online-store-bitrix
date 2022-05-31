<?php

namespace Sprint\Migration;


class Version20220531142715 extends Version
{
  protected $description = "Миграция для инфоблоков Контакты и Адреса";

  protected $moduleVersion = "4.0.6";

  public function up()
  {
    $helper = $this->getHelperManager();
    // Создаем тип инфоблока - Контакты
    $helper->Iblock()->saveIblockType(array(
      'ID' => 'contacts',
      'SECTIONS' => 'Y',
      'SORT' => '500',
      'LANG' =>
        array(
          'ru' =>
            array(
              'NAME' => 'Контакты',
            ),
          'en' =>
            array(
              'NAME' => 'Contacts',
            ),
        ),
    ));

// Создаем инфоблок Контакты и его свойства
    $iblockId1 = $helper->Iblock()->saveIblock(array(
      'IBLOCK_TYPE_ID' => 'contacts',
      'LID' =>
        array(
          0 => 's1',
        ),
      'CODE' => 'contact',
      'API_CODE' => 'contact',
      'NAME' => 'Контакты',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'LIST_PAGE_URL' => '#SITE_DIR#/contacts/index.php?ID=#IBLOCK_ID#',
      'DETAIL_PAGE_URL' => '#SITE_DIR#/contacts/detail.php?ID=#ELEMENT_ID#',
      'SECTION_PAGE_URL' => '#SITE_DIR#/contacts/list.php?SECTION_ID=#SECTION_ID#',
      'SECTIONS_NAME' => 'Разделы',
      'SECTION_NAME' => 'Раздел',
      'ELEMENTS_NAME' => 'Элементы',
      'ELEMENT_NAME' => 'Элемент',
      'LANG_DIR' => '/',
      'SERVER_NAME' => 'online-store-bitrix',
    ));
    $helper->Iblock()->saveProperty($iblockId1, array(
      'NAME' => 'ФИО',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'FULLNAME',
      'PROPERTY_TYPE' => 'S',
    ));
    $helper->Iblock()->saveProperty($iblockId1, array(
      'NAME' => 'Телефон',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'PHONE',
      'PROPERTY_TYPE' => 'S',
    ));
    $helper->Iblock()->saveProperty($iblockId1, array(
      'NAME' => 'Адрес',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'ADDRESS',
      'PROPERTY_TYPE' => 'E',
      'LINK_IBLOCK_ID' => 'contacts:addresses',
    ));

// Создаем инфоблок Адреса и его свойства
    $iblockId2 = $helper->Iblock()->saveIblock(array(
      'IBLOCK_TYPE_ID' => 'contacts',
      'LID' =>
        array(
          0 => 's1',
        ),
      'CODE' => 'addresses',
      'API_CODE' => 'addresses',
      'NAME' => 'Адреса',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'LIST_PAGE_URL' => '#SITE_DIR#/contacts/index.php?ID=#IBLOCK_ID#',
      'DETAIL_PAGE_URL' => '#SITE_DIR#/contacts/detail.php?ID=#ELEMENT_ID#',
      'SECTION_PAGE_URL' => '#SITE_DIR#/contacts/list.php?SECTION_ID=#SECTION_ID#',
      'SECTIONS_NAME' => 'Разделы',
      'SECTION_NAME' => 'Раздел',
      'ELEMENTS_NAME' => 'Элементы',
      'ELEMENT_NAME' => 'Элемент',
      'LANG_DIR' => '/',
      'SERVER_NAME' => 'online-store-bitrix',
    ));
    $helper->Iblock()->saveProperty($iblockId2, array(
      'NAME' => 'Город',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'CITY',
      'PROPERTY_TYPE' => 'S',
    ));
    $helper->Iblock()->saveProperty($iblockId2, array(
      'NAME' => 'Улица',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'STREET',
      'PROPERTY_TYPE' => 'S',
    ));
    $helper->Iblock()->saveProperty($iblockId2, array(
      'NAME' => 'Номер дома',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'HOUSE',
      'PROPERTY_TYPE' => 'N',
    ));
    $helper->Iblock()->saveProperty($iblockId2, array(
      'NAME' => 'Квартира',
      'ACTIVE' => 'Y',
      'SORT' => '500',
      'CODE' => 'FLAT',
      'PROPERTY_TYPE' => 'N',
    ));

  }


  public function down()
  {
    $helper = $this->getHelperManager();
    $iblockId1 = $helper->Iblock()->getIblockIdIfExists('contact', 'contacts');
    $iblockId2 = $helper->Iblock()->getIblockIdIfExists('addresses', 'contacts');

//    Удаляем свойства инфоблока Адреса
    $helper->Iblock()->deletePropertyIfExists($iblockId2, 'CITY');
    $helper->Iblock()->deletePropertyIfExists($iblockId2, 'STREET');
    $helper->Iblock()->deletePropertyIfExists($iblockId2, 'HOUSE');
    $helper->Iblock()->deletePropertyIfExists($iblockId2, 'FLAT');
//    Удаляем инфоблок Адреса
    $helper->Iblock()->deleteIblock($iblockId2);
//    Удаляем свойства инфоблока Контакты
    $helper->Iblock()->deletePropertyIfExists($iblockId1, 'FULLNAME');
    $helper->Iblock()->deletePropertyIfExists($iblockId1, 'PHONE');
    $helper->Iblock()->deletePropertyIfExists($iblockId1, 'ADDRESS');
//    Удаляем инфоблок Контакты
    $helper->Iblock()->deleteIblock($iblockId1);
//    Удаляем тип инфоблока - Контакты
      $helper->Iblock()->deleteIblockType('contacts');

  }
}
