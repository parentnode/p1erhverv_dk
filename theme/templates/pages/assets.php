<?
$IC = new Items();
global $action;

$sindex = $action[0];
$item = $IC->getItem(array("sindex" => $sindex, "extend" => array("mediae" => true)));

?>
<div class="scene assets i:scene">

<? if($item): ?>

	<div class="assets" itemscope itemtype="http://schema.org/Product">

		<h1 itemprop="headline"><?= $item["name"] ?></h1>

		<ul class="mediae">
		<? foreach($item["mediae"] as $media): ?>
			<li><a href="/download/<?= $media["item_id"] ?>/<?= $media["variant"] ?>/<?= supernormalize($media["name"]) ?>.<?= $media["format"] ?>"><?= $media["name"] ?></a>
		<? endforeach; ?>
		</ul>

	</div>

<? endif; ?>

</div>