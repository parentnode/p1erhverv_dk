<?
$IC = new Items();
global $action;

$sindex = $action[0];
$item = $IC->getItem(array("sindex" => $sindex, "extend" => array("mediae" => true)));

?>
<div class="scene assets i:assets">

<? if($item): ?>

	<div class="assets" itemscope itemtype="http://schema.org/Product">

		<h1 itemprop="headline"><?= $item["name"] ?></h1>

		<ul class="assets">
		<? foreach($item["mediae"] as $media): ?>
			<li class="asset">
				<span class="file_name"><?= $media["name"] ?></span><br />
				<a href="/asset-download/<?= $media["item_id"] ?>/<?= $media["variant"] ?>/<?= supernormalize($media["name"]) ?>.<?= $media["format"] ?>">Link</a> – <span class="link_text"><?= SITE_URL ?>/asset-download/<?= $media["item_id"] ?>/<?= $media["variant"] ?>/<?= supernormalize($media["name"]) ?>.<?= $media["format"] ?></span>
		<? endforeach; ?>
		</ul>

	</div>

<? endif; ?>

</div>