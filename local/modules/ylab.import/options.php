<?php

/** @global CUser $USER */
/** @var CMain $APPLICATION */

if (!$USER->IsAdmin()) {
  return;
}

use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

$module_id = 'ylab.import';

Loc::loadMessages(__FILE__);

Loader::includeModule($module_id);


$request = Application::getInstance()->getContext()->getRequest();

$aTabs = [
  [
    "DIV" => "ylab_import_tab1",
    "TAB" => Loc::getMessage("YLAB.IMPORT.SETTINGS1"),
    "ICON" => "settings",
    "TITLE" => Loc::getMessage("YLAB.IMPORT.TITLE1"),
  ],
];


$aTabs[] = [
  'DIV' => 'rights',
  'TAB' => GetMessage('MAIN_TAB_RIGHTS'),
  'TITLE' => GetMessage('MAIN_TAB_TITLE_RIGHTS')
];

$arAllOptions = [

  'main' => [
    Loc::getMessage("YLAB.IMPORT.NOTE.TITLE.TAB1"),
    ['note' => Loc::getMessage("YLAB.IMPORT.NOTE.NOTE1")],
    ["limit_to_import", Loc::getMessage("YLAB.IMPORT.LIMIT_TO_IMPORT"), '', ['text', '']],
    ["textarea", 'textarea', '', ['textarea', '8', '60']],
    Loc::getMessage("YLAB.IMPORT.NOTE.TITLE.TAB2"),
    ['note' => Loc::getMessage("YLAB.IMPORT.NOTE.NOTE2")],
    ['password', Loc::getMessage("YLAB.IMPORT.PASSWORD"), '', ['password', 20]],
    ['note' => Loc::getMessage("YLAB.IMPORT.NOTE.NOTE3")],
    ['checkbox1', Loc::getMessage("YLAB.IMPORT.CHECKBOX1"), '', ['checkbox', '', 'onclick=""']],
    ['checkbox2', Loc::getMessage("YLAB.IMPORT.CHECKBOX2"), '', ['checkbox',]],
    ['note' => Loc::getMessage("YLAB.IMPORT.NOTE.NOTE4")],
    ['selectbox', Loc::getMessage("YLAB.IMPORT.SELECTBOX"), 'val1', ['selectbox',
      [
        "val1" => Loc::getMessage("YLAB.IMPORT.SELECTBOX.VAL1"),
        "val2" => Loc::getMessage("YLAB.IMPORT.SELECTBOX.VAL2"),
        "val3" => Loc::getMessage("YLAB.IMPORT.SELECTBOX.VAL3")
      ]]],
    ['multiselectbox', Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX"), 'val2', ['multiselectbox',
      [
        "val1" => Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX.VAL1"),
        "val2" => Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX.VAL2"),
        "val3" => Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX.VAL3")
      ]],
      'N'
    ],
    Loc::getMessage("YLAB.IMPORT.NOTE.TITLE.TAB3"),
    ['note' => Loc::getMessage("YLAB.IMPORT.NOTE.NOTE5")],
    ['statictext', Loc::getMessage("YLAB.IMPORT.NOTE.NOTE6"), 'Текст текст текст <b>текст</b>', ['statictext']],
    ['statichtml', Loc::getMessage("YLAB.IMPORT.NOTE.NOTE7"), 'Html <span style="color:green;"><b>html</b></span> html html', ['statichtml']],
  ],


];

if (($request->get('save') !== null || $request->get('apply') !== null) && check_bitrix_sessid()) {

  __AdmSettingsSaveOptions($module_id, $arAllOptions['main']);

}


$tabControl = new CAdminTabControl("tabControl", $aTabs);

?>
<form method="post"
      action="<?= $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($module_id) ?>&lang=<?= LANGUAGE_ID ?>"
      name="ylab_import"><?
  echo bitrix_sessid_post();

  $tabControl->Begin();

    $tabControl->BeginNextTab();

    __AdmSettingsDrawList($module_id, $arAllOptions["main"]);

  $tabControl->BeginNextTab();

  require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/admin/group_rights.php';

  $tabControl->Buttons([]);

  $tabControl->End();
  ?><input type="hidden" name="Update" value="Y"
</form>
