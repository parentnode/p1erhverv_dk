<?php
	
$model = new Model();

$this->pageTitle("Glemt kode?");
?>
<div class="scene login i:login">
	<h1>Har du glemt din kode?</h1>
	<p>Skriv din email-adresse herunder, så sender vi en mail med information om hvordan du nulstiller din kode.</p>

	<?= $model->formStart("requestReset", array("class" => "labelstyle:inject")) ?>

<?	if(message()->hasMessages(array("type" => "error"))): ?>
		<p class="errormessage">
<?		$messages = message()->getMessages(array("type" => "error"));
		message()->resetMessages();
		foreach($messages as $message): ?>
			<?= $message ?><br>
<?		endforeach;?>
		</p>
<?	endif; ?>

		<fieldset>
			<?= $model->input("username", array("type" => "string", "label" => "Email-adresse", "required" => true, "pattern" => "[\w\.\-\_]+@[\w-\.]+\.\w{2,4}|([\+0-9\-\.\s\(\)]){5,18}", "hint_message" => "Skriv din email-adresse.", "error_message" => "Invalid email-adresse.")); ?>
		</fieldset>

		<ul class="actions">
			<?= $model->submit("Anmod om nulstilling", array("class" => "primary", "wrapper" => "li.reset")) ?>
		</ul>
	<?= $model->formEnd() ?>

</div>
