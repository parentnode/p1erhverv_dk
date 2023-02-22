<?php
$access_item["/"] = true;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();
$IC = new Items();
$itemtype = "asset";


$page->bodyClass("asset");
$page->pageTitle("Asset");



// news list for tags
// /posts/#sindex#
if(count($action) == 1) {

	$page->page(array(
		"templates" => "pages/assets.php"
	));
	exit();

}

$page->page(array(
	"templates" => "pages/404.php"
));
exit();

