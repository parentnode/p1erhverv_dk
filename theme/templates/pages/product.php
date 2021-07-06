<?
$IC = new Items();
global $action;

$sindex = $action[0];
$item = $IC->getItem(array("sindex" => $sindex, "extend" => array("user" => true, "mediae" => true)));

?>
<div class="scene product i:scene">

	<ul class="actions">
		<li><a href="/">Tilbage til oversigten</a></li>
	</ul>

<? if($item): ?>

	<div class="product i:product<?= $HTML->jsMedia($item) ?>" itemscope itemtype="http://schema.org/Product">

		<h1 itemprop="headline"><?= $item["name"] ?></h1>

		<? if($item["html"]): ?>
		<div class="articlebody" itemprop="articleBody">
			<?= $item["html"] ?>
		</div>
		<? endif; ?>

	</div>

<? endif; ?>

</div>