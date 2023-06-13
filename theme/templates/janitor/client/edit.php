<?php
global $action;
global $IC;
global $model;
global $itemtype;

$item_id = $action[1];
$item = $IC->getItem(array("id" => $item_id, "extend" => true));

$active_items = $model->getProducts($item_id);
$passive_items = $IC->getItems(array("itemtype" => "product", "status" => 1, "extend" => ["tags" => true]));

$users = $model->getUsers($item_id);
$model->getContexts($item_id);
$contexts = $model->getContexts($item_id);

?>
<div class="scene defaultEdit <?= $itemtype ?>Edit">
	<h1>Edit client</h1>
	<h2><?= $item["name"] ?></h2>

	<?= $JML->editGlobalActions($item) ?>

	<div class="item i:defaultEdit i:collapseHeader">
		<h2>Client details</h2>
		<?= $model->formStart("update/".$item["id"], array("class" => "labelstyle:inject")) ?>

			<fieldset>
				<?= $model->input("name", array("value" => $item["name"])) ?>
				<?= $model->input("html", array("value" => $item["html"])) ?>

				<?= $model->input("buy_button", array("type" => "checkbox", "value" => $item["buy_button"])) ?>
				<?= $model->input("instant_delivery", array("type" => "checkbox", "value" => $item["instant_delivery"])) ?>
				<?= $model->input("show_price", array("type" => "checkbox", "value" => $item["show_price"])) ?>
			</fieldset>

			<?= $JML->editActions($item) ?>

		<?= $model->formEnd() ?>
	</div>

	<div class="products i:collapseHeader">
		<h2>Products</h2>
		<p>Select which products should be visible for this client.</p>
		<h3>Products for <?= $item["name"] ?></h3>
		<div class="all_items active filters sortable i:defaultList i:activeProducts"
		 	data-csrf-token="<?= session()->value("csrf") ?>" 
			data-item-order="<?= security()->validPath("/janitor/client/updateProductOrder/".$item["id"]) ?>"
			data-item-remove="<?= security()->validPath("/janitor/client/removeProduct/".$item["id"]) ?>"
		 	>
			<ul class="items">
			<? foreach($active_items as $a_item): ?>
				<li class="item product id:<?= $a_item["id"] ?> item_id:<?= $a_item["id"] ?>">
					<h3><?= strip_tags($a_item["name"]) ?></h3>

					<?= $JML->tagList($a_item["tags"]) ?>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
		<h3>Other available products</h3>
		<div class="all_items inactive filters i:defaultList i:inactiveProducts"
		 	data-csrf-token="<?= session()->value("csrf") ?>" 
			data-item-add="<?= security()->validPath("/janitor/client/addProduct/".$item["id"]) ?>"
		 	>
			<ul class="items">
			<? foreach($passive_items as $p_item): ?>
				<li class="item product id:<?= $p_item["id"] ?> item_id:<?= $p_item["id"] ?><?= (arrayKeyValue($active_items, "id", $p_item["id"]) !== false) ? " active" : "" ?>">
					<h3><?= strip_tags($p_item["name"]) ?></h3>

					<?= $JML->tagList($p_item["tags"]) ?>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
	</div>

	<div class="users i:collapseHeader i:clientUsers"
		data-csrf-token="<?= session()->value("csrf") ?>" 
		data-item-remove="<?= security()->validPath("/janitor/client/removeUser/".$item["id"]) ?>"
		data-item-add="<?= security()->validPath("/janitor/client/addUser/".$item["id"]) ?>"
		>
		<h2>Users</h2>

		<ul class="users">
		<? foreach($users as $user): ?>
			<li class="user user_id:<?= $user["id"] ?><?= $user["selected"] ? " selected" : "" ?>"><?= $user["nickname"] ?></li>
		<? endforeach; ?>
		</ul>
	</div>

	<div class="contexts i:collapseHeader">
		<h2>Contexts</h2>
		<p>
			You can also add additional tag-context filters, by adding additional tag-contexts below.
		</p>
		<h3>Active contexts</h3>
		<div class="all_items active filters sortable i:defaultList i:activeContexts"
		 	data-csrf-token="<?= session()->value("csrf") ?>" 
			data-item-order="<?= security()->validPath("/janitor/client/updateContextOrder/".$item["id"]) ?>"
			data-item-remove="<?= security()->validPath("/janitor/client/removeContext/".$item["id"]) ?>"
		 	>
			<ul class="items">
			<? foreach($contexts["client"] as $a_item): ?>
				<li class="item context item_id:<?= $a_item["context"] ?>">
					<h3><?= $a_item["context"] ?></h3>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
		<h3>Passive contexts</h3>
		<div class="all_items inactive filters i:defaultList i:inactiveContexts"
		 	data-csrf-token="<?= session()->value("csrf") ?>" 
			data-item-add="<?= security()->validPath("/janitor/client/addContext/".$item["id"]) ?>"
		 	>
			<ul class="items">
			<? foreach($contexts["all"] as $p_item): ?>
				<li class="item context item_id:<?= $p_item["context"] ?><?= (arrayKeyValue($contexts["client"], "context", $p_item["context"]) !== false) ? " active" : "" ?>">
					<h3><?= $p_item["context"] ?></h3>
				</li>
			<? endforeach; ?>
			</ul>
		</div>
	</div>

</div>
