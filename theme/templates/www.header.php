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
	<link type="text/css" rel="stylesheet" media="all" href="/css/seg_<?= $this->segment() ?>.css?rev=20230222-103845" />
	<script type="text/javascript" src="/js/seg_<?= $this->segment() ?>.js?rev=20230222-103845"></script>
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
			<li class="keynav user logoff nofollow"><a href="?logoff=true">Logoff</a></li>
<?		else: ?>
			<li class="keynav user login nofollow"><a href="<?= SITE_LOGIN_URL ?>">Login</a></li>
<?		endif; ?>
		</ul>
	</div>

	<div id="content">
