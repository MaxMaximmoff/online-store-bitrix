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
  <label><?= Loc::getMessage('YLAB.IMPORT.CHECKBOX1') ?>
    <input type="checkbox" name="checkbox1" value="Y">
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.CHECKBOX2') ?>
    <input type="checkbox" name="checkbox2" value="Y">
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.SELECTBOX') ?>
    <select name="selectbox">
      <option value="var1">var1</option>
      <option value="var2">var2</option>
      <option value="var3">var3</option>
      <option value="var4">var4</option>
    </select>
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.MULTISELECTBOX') ?>
    <select name="multiselectbox[]" multiple size="5">
      <option value="var1">var1</option>
      <option value="var2">var2</option>
      <option value="var3">var3</option>
      <option value="var4">var4</option>
    </select>
  </label><br><br>

  <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
  <input type="hidden" name="id" value="ylab.import">
  <input type="hidden" name="install" value="Y">
  <input type="hidden" name="step" value="3">
  <input type="submit" name="" value="<?= Loc::getMessage('YLAB.IMPORT.NEXT') ?>">
</form>
