<?php

use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) { return; }
Loc::loadMessages(__FILE__);
?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
    <?= bitrix_sessid_post() ?>
  <label><?= Loc::getMessage('YLAB.IMPORT.LIMIT_TO_IMPORT') ?><br>
    <input type="text" name="limit_to_import" value="">
  </label><br><br>
  <label><?= Loc::getMessage('YLAB.IMPORT.TEXTAREA') ?><br>
    <textarea name="textarea" cols="60" rows="8"></textarea>
  </label><br><br>

  <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
  <input type="hidden" name="id" value="ylab.import">
  <input type="hidden" name="install" value="Y">
  <input type="hidden" name="step" value="2">
  <input type="submit" name="" value="<?= Loc::getMessage('YLAB.IMPORT.NEXT') ?>">
</form>
