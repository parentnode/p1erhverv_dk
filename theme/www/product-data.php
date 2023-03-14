<?php
$access_item = false;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "product";


$page->bodyClass("product");
$page->pageTitle("Produkt-data");



$page->page(array(
	"templates" => "pages/product-data.php"
));
exit();


?>
 