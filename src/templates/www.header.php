<!DOCTYPE html>
<html lang="<?= $this->language() ?>">
<head>
	<!-- (c) & (p) think.dk 2002-2017 -->
	<!-- If you want to use or contribute to this code, visit http://parentnode.dk -->
	<title><?= $this->pageTitle() ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="development frontend HTML JavaScript CSS idealism web" />
	<meta name="description" content="<?= $this->pageDescription() ?>" />
	<meta name="viewport" content="initial-scale=1, user-scalable=no" />

	<?= $this->sharingMetaData() ?>

	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<? if(session()->value("dev")) { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/lib/seg_<?= $this->segment() ?>_include.css" />
	<script type="text/javascript" src="/js/lib/seg_<?= $this->segment() ?>_include.js"></script>
<? } else { ?>
	<link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= $this->segment() ?>.css?rev=2" />
	<script type="text/javascript" src="/js/seg_<?= $this->segment() ?>.js?rev=2"></script>
<? } ?>

	<?= $this->headerIncludes() ?>
</head>

<body<?= $HTML->attribute("class", $this->bodyClass()) ?>>

<div id="page" class="i:page">

	<div id="header">
		<ul class="servicenavigation">
			<li class="keynav navigation nofollow"><a href="#navigation">To navigation</a></li>
<?		if(session()->value("user_id") && session()->value("user_group_id") > 1): ?>
			<?= $HTML->link("Janitor", "/janitor", array("wrapper" => "li.keynav.admin.nofollow")); ?>
			<li class="keynav user nofollow"><a href="?logoff=true">Logoff</a></li>
			<li class="keynav order nofollow"><a href="mailto:sl@punkt1.dk?subject=Rekvisition:%20[Anfør%20nummer%20her]&body=Bestilling%20fra%20p1erhverv.dk%0D%0A%0D%0AVedhæft%20rekvisition%20–%20og%20send.%20Så%20vender%20vi%20tilbage%20med%20en%20bekræftelse%20hurtigst%20muligt.">Bestil nu</a></li>
<?		else: ?>
			<li class="keynav user nofollow"><a href="/login">Login</a></li>
<?		endif; ?>
		</ul>
	</div>

	<div id="content">
