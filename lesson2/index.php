<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<?php
$APPLICATION->IncludeComponent(
  "mylab:gift",
  "",
  []
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
