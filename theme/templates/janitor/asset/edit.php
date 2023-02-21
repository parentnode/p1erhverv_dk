<?php
global $action;
global $IC;
global $itemtype;
global $model;

$item_id = $action[1];
$item = $IC->getItem(array("id" => $item_id, "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit asset</h1>
	<h2><?= $item["name"] ?></h2>

	<?= $JML->editGlobalActions($item) ?>

	<div class="url">
		<h2>Offentlig url</h2>
		<p>Nedenstående PDF'er kan ses på <a href="<?= SITE_URL ?>/asset/<?= $item["sindex"] ?>" target="_blank"><?= SITE_URL ?>/asset/<?= $item["sindex"] ?></a>.</p>
	</div>

	<div class="item i:defaultEdit">
		<h2>Asset details</h2>
		<?= $model->formStart("update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
			</fieldset>

			<?= $JML->editActions($item) ?>
		<?= $model->formEnd() ?>
	</div>

	<?= $JML->editMediae($item) ?>

</div>
