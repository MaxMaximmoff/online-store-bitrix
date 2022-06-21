<?php

use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) { return; }
Loc::loadMessages(__FILE__);
?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
  <?= bitrix_sessid_post() ?>
  <label><?= Loc::getMessage('YLAB.IMPORT.PASSWORD') ?><br>
    <input type="password" name="password" value="">
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.CHECKBOX1') ?></label><br>
    <input type="checkbox" name="checkbox_1">
  <br>
  <label><?= Loc::getMessage('YLAB.IMPORT.CHECKBOX2') ?></label><br>
    <input type="checkbox" name="checkbox_2">
  <br>
  <label><?= Loc::getMessage('YLAB.IMPORT.SELECTBOX') ?>
    <select name="selectbox">
      <option value="val1"><?= Loc::getMessage("YLAB.IMPORT.SELECTBOX_VAL1") ?></option>
      <option value="val2"><?= Loc::getMessage("YLAB.IMPORT.SELECTBOX_VAL2") ?></option>
      <option value="val3"><?= Loc::getMessage("YLAB.IMPORT.SELECTBOX_VAL3") ?></option>
    </select>
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.MULTISELECTBOX') ?>
    <select name="multiselectbox[]" multiple size="3">
      <option value="val1"><?= Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX_VAL1") ?></option>
      <option value="val2"><?= Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX_VAL2") ?></option>
      <option value="val3"><?= Loc::getMessage("YLAB.IMPORT.MULTISELECTBOX_VAL3") ?></option>
    </select>
  </label><br><br>

  <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
  <input type="hidden" name="id" value="ylab.import">
  <input type="hidden" name="install" value="Y">
  <input type="hidden" name="step" value="3">
  <input type="submit" name="" value="<?= Loc::getMessage('YLAB.IMPORT.NEXT') ?>">
</form>
