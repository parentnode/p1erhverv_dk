<?php
global $action;
global $IC;
global $itemtype;
global $model;

$item_id = $action[1];
$item = $IC->getItem(array("id" => $item_id, "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit product</h1>
	<h2><?= $item["name"] ?></h2>

	<?= $JML->editGlobalActions($item) ?>

	<div class="item i:defaultEdit">
		<h2>Product details</h2>
		<?= $model->formStart("update/".$item_id, array("class" => "labelstyle:inject")) ?>
			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("description", array("class" => "autoexpand", "value" => $item["description"])) ?>
				<?= $model->input("ean", array("value" => $item["ean"])) ?>
				<?= $model->input("price", array("value" => $item["price"])) ?>
				<?= $model->inputHTML("html", array("value" => $item["html"])) ?>
			</fieldset>

			<?= $JML->editActions($item) ?>
		<?= $model->formEnd() ?>
	</div>

	<?= $JML->editTags($item) ?>

	<?= $JML->editMedia($item) ?>

</div>
