<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Контакты клиентов");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"link", 
	array(
		"IBLOCK_TYPE" => "contacts",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "5",
		"PROPERTY_CODE" => [
			'PHONE',
			'FULLNAME',
			'ADDRESS'
		],
		"COMPONENT_TEMPLATE" => "link",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",

	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

