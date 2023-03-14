<?
$IC = new Items();
global $action;


?>
<div class="scene product i:productData">

	<?= $HTML->formStart("#"); ?>
		<fieldset>
			<?= $HTML->input("ids", ["type" => "string", "label" => "product id"]) ?>
		</fieldset>
		<ul class="actions">
			<?= $HTML->submit("Hent", ["wrapper" => "li.get"]) ?>
		</ul>
	<?= $HTML->formEnd() ?>

	<div class="result"></div>

</div>