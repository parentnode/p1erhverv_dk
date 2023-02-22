<?php
global $action;
global $IC;
global $model;
global $itemtype;

$items = $IC->getItems(array("itemtype" => $itemtype, "order" => "status DESC", "extend" => array("tags" => true, "mediae" => true)));
?>
<div class="scene i:scene defaultList <?= $itemtype ?>List">
	<h1>Assets</h1>

	<ul class="actions">
		<?= $JML->listNew(array("label" => "New asset collection")) ?>
	</ul>

	<div class="all_items i:defaultList filters">
<?		if($items): ?>
		<ul class="items">
<?			foreach($items as $item): ?>
			<li class="item item_id:<?= $item["id"] ?><?= $HTML->jsMedia($item) ?>">
				<h3><?= strip_tags($item["name"]) ?></h3>

				<?= $JML->listActions($item) ?>
			 </li>
<?			endforeach; ?>
		</ul>
<?		else: ?>
		<p>No asset collections.</p>
<?		endif; ?>
	</div>

</div>
