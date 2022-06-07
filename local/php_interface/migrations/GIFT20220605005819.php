<?php

namespace Sprint\Migration;


class GIFT20220605005819 extends Version
{
  protected $description = "Миграция подарка";

  protected $moduleVersion = "4.0.6";

  /**
   * @return bool|void
   * @throws Exceptions\RestartException
   * @throws Exceptions\ExchangeException
   */
  public function up()
  {

    $helper = $this->getHelperManager();

    $iblockId = $helper->Iblock()->getIblockIdIfExists(
      'clothes',
      'catalog'
    );

    $helper->Iblock()->addSectionIfNotExists(
      $iblockId,
      array(
        'NAME' => 'Подарки',
        'CODE' => 'podarki',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'UF_BROWSER_TITLE' => NULL,
        'UF_KEYWORDS' => NULL,
        'UF_META_DESCRIPTION' => NULL,
        'UF_BACKGROUND_IMAGE' => NULL,
      )
    );

    $this->getExchangeManager()
      ->IblockElementsImport()
      ->setExchangeResource('iblock_elements.xml')
      ->setLimit(20)
      ->execute(function ($item) {
        $this->getHelperManager()
          ->Iblock()
          ->addElement(
            $item['iblock_id'],
            $item['fields'],
            $item['properties']
          );
      });
  }

  public function down()
  {
    $helper = $this->getHelperManager();
    $iblockId = $helper->Iblock()->getIblockIdIfExists('clothes', 'catalog');
    $helper->Iblock()->deleteElementIfExists($iblockId, 'New-Era-115');
    $helper->Iblock()->deleteSectionIfExists($iblockId, podarki);
  }
}
