<?php
$access_item["/"] = true;
if(isset($read_access) && $read_access) {
	return;
}

include_once($_SERVER["FRAMEWORK_PATH"]."/config/init.php");


$action = $page->actions();


$page->bodyClass("front");
$page->pageTitle("Punkt1 Erhverv");



$page->page(array(
	"templates" => "pages/front.php"
	)
);
exit();


?>
 