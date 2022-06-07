<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use Ylab\Helpers;

$APPLICATION->SetTitle("Контакты клиентов");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"link", 
	[
		"IBLOCK_TYPE" => "contacts",
		"IBLOCK_ID" => Helpers::getIBlockIdByCode('contact'),
		"PROPERTY_CODE" => [
			'FULLNAME',
			'PHONE',
			'ADDRESS'
		],
		"FIELD_CODE" => [
			'PROPERTY_ADDRESS.PROPERTY_CITY',
			'PROPERTY_ADDRESS.PROPERTY_STREET',
			'PROPERTY_ADDRESS.PROPERTY_HOUSE',
			'PROPERTY_ADDRESS.PROPERTY_FLAT',
		],
	]
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

