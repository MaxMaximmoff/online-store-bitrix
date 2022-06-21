<?php

use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) { return; }
Loc::loadMessages(__FILE__);
?>

<form action="<?= $APPLICATION->GetCurPage() ?>">
  <?= bitrix_sessid_post() ?>
  <textarea name="statictext" cols="60" rows="8"><?= Loc::getMessage('YLAB.IMPORT.STATICTEXT') ?></textarea><br><br>
  <textarea name="statichtml" cols="60" rows="8"><?= Loc::getMessage('YLAB.IMPORT.STATICHTML') ?></textarea><br><br>

  <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
  <input type="hidden" name="id" value="ylab.import">
  <input type="hidden" name="install" value="Y">
  <input type="hidden" name="step" value="4000">
  <input type="submit" name="save" value="<?= Loc::getMessage('YLAB.IMPORT.SAVE') ?>" class="adm-btn-save"
         title="<?= Loc::getMessage('YLAB.IMPORT.SAVE_AND_BACK') ?>">
  <input type="submit" name="apply" value="<?= Loc::getMessage('YLAB.IMPORT.APPLAY') ?>"
         title="<?= Loc::getMessage('YLAB.IMPORT.APPLAY_TITLE') ?>">
</form>
