<?php
// composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/local/log/" . date("Y_m_d") . ".log");
//AddEventHandler('iblock', 'OnAfterIblockElementAdd', 'addLogRecord');
AddEventHandler('iblock', 'OnAfterIBlockAdd', 'addLogRecord');

function addLogRecord(&$arFields)
{
  if ($arFields['RESULT']) {
    $message = ' Новый каталог добавлен';
  } else {
    $message = ' Новый каталог не добавлен. ' . $arFields["RESULT_MESSAGE"];
  }

  AddMessage2Log($arFields['NAME'] . " ($message)", 'Catalog');
}


