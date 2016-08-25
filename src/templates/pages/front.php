<?
$IC = new Items();
$itemtype = "client";
$typeClient = $IC->typeObject($itemtype);

// get clients for current user
$clients = $typeClient->getClients();


$selected_contexts = session()->value("selected_contexts");
$items = false;

// context = client_id/context/tag_id
$context = getVar("context");
if($context) {
	list($client_id, $context_value, $tag_id) = explode("/", $context);

	$new_context_point = false;
	$selected_contexts[$client_id][$context_value] = $tag_id;

	foreach($selected_contexts[$client_id] as $selected_context => $tag_id) {
		if($new_context_point) {
			unset($selected_contexts[$client_id][$selected_context]);
		}

		if($selected_context == $context_value) {
			$new_context_point = true;
		}

	}

	session()->value("selected_contexts", $selected_contexts);
}
// test reset context value
//session()->reset("selected_contexts");

?>
<div class="scene front i:front">

<? if($clients): ?>

	<? if(count($clients) > 1): ?>
	<ul class="clients">
	<? foreach($clients as $client): ?>
		<li class="client" data-tab="<?= superNormalize($client["name"]) ?>"><?= $client["name"] ?></li>
	<? endforeach; ?>
	</ul>
	<? endif; ?>

	<? foreach($clients as $client):
		$media = $IC->sliceMedia($client); ?>

	<div class="client" id="<?= superNormalize($client["name"]) ?>">
		<div class="article" itemscope itemtype="http://schema.org/Article">

			<h1 itemprop="headline"><?= $client["name"] ?></h1>

			<ul class="info">
				<li class="published_at" itemprop="datePublished" content="<?= date("Y-m-d", strtotime($client["published_at"])) ?>"><?= date("Y-m-d, H:i", strtotime($client["published_at"])) ?></li>
				<li class="modified_at" itemprop="dateModified" content="<?= date("Y-m-d", strtotime($client["modified_at"])) ?>"><?= date("Y-m-d, H:i", strtotime($client["published_at"])) ?></li>
				<li class="author" itemprop="author"><?= $client["user_nickname"] ?></li>
				<li class="main_entity share" itemprop="mainEntityOfPage"><?= SITE_URL ?></li>
				<li class="publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
					<ul class="publisher_info">
						<li class="name" itemprop="name">think.dk</li>
						<li class="logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<span class="image_url" itemprop="url" content="<?= SITE_URL ?>/img/logo-large.png"></span>
							<span class="image_width" itemprop="width" content="720"></span>
							<span class="image_height" itemprop="height" content="405"></span>
						</li>
					</ul>
				</li>
				<li class="image_info" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<span class="image_url" itemprop="url" content="<?= SITE_URL ?>/img/logo-large.png"></span>
					<span class="image_width" itemprop="width" content="720"></span>
					<span class="image_height" itemprop="height" content="405"></span>
				</li>
			</ul>

			<? if($client["html"]): ?>
			<div class="articlebody" itemprop="articleBody">
				<?= $client["html"] ?>
			</div>
			<? endif; ?>
		</div>

		<?
		$client_contexts = $typeClient->getContexts($client["id"]);
		if($client_contexts["client"]): ?>

		<div class="contexts">
			<h2>Vælg mærke og sortiment</h2>
			<ul class="contexts">
			<?
			foreach($client_contexts["client"] as $context):
				$tags = $IC->getTags(array("context" => $context["context"])); ?>
				<? print_r($tags); ?>
				<li class="context">
					<ul class="context_options">
						<? foreach($tags as $tag): ?>
						<li class="context<?= isset($selected_contexts[$client["id"]][$context["context"]]) && $selected_contexts[$client["id"]][$context["context"]] == $tag["id"] ? " selected" : ""?>"><a href="?context=<?= $client["id"] ?>/<?= $context["context"] ?>/<?= $tag["id"] ?>"><?= $tag["value"] ?></a></li>
						<? endforeach; ?>
					</ul>
				
				</li>
				<?
				if(!isset($selected_contexts[$client["id"]][$context["context"]])) {
					break;
				}
			endforeach;
			?>
			</ul>
		</div>
			<?
			// ready to actually get items
			if(count($client_contexts["client"]) == count($selected_contexts[$client["id"]])):
				$items = $typeClient->getProducts($client["id"], $selected_contexts[$client["id"]]);
			endif;

		// no extra client context
		else: 

			// just get all client items
			$items = $typeClient->getProducts($client["id"]);

		endif; 
		?>

		<? if($items): ?>

		<div class="products i:products">
			<h2>Produkter</h2>
			<ul class="items products">
			<? foreach($items as $item): ?>
				<li class="item product id:<?= $item["item_id"] ?><?= $JML->jsMedia($item) ?>" itemscope itemtype="http://schema.org/Product">

					<ul class="tags">
					<? if($item["tags"]): ?>
						<? foreach($item["tags"] as $item_tag): ?>
							<? if($item_tag["context"] == "category"): ?>
						<li itemprop="category" class="tag"><?= $item_tag["value"] ?></li>
							<? endif; ?>
						<? endforeach; ?>
					<? endif; ?>
					</ul>

					<h3 itemprop="headline"><?= $item["name"] ?></h3>

					<ul class="info">
						<li class="published_at" itemprop="datePublished" content="<?= date("Y-m-d", strtotime($item["published_at"])) ?>"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></li>
						<li class="modified_at" itemprop="dateModified" content="<?= date("Y-m-d", strtotime($item["modified_at"])) ?>"><?= date("Y-m-d, H:i", strtotime($item["published_at"])) ?></li>
						<li class="author" itemprop="author"><?= $item["user_nickname"] ?></li>
						<li class="main_entity" itemprop="mainEntityOfPage"><?= SITE_URL."/product/".$item["sindex"] ?></li>
						<li class="publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<ul class="publisher_info">
								<li class="name" itemprop="name">p1erhverv.dk</li>
								<li class="logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
									<span class="image_url" itemprop="url" content="<?= SITE_URL ?>/img/logo-large.png"></span>
									<span class="image_width" itemprop="width" content="720"></span>
									<span class="image_height" itemprop="height" content="405"></span>
								</li>
							</ul>
						</li>
						<li class="image_info" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
						<? if($media): ?>
							<span class="image_url" itemprop="url" content="<?= SITE_URL ?>/images/<?= $item["item_id"] ?>/<?= $media["variant"] ?>/720x.<?= $media["format"] ?>"></span>
							<span class="image_width" itemprop="width" content="720"></span>
							<span class="image_height" itemprop="height" content="<?= floor(720 / ($media["width"] / $media["height"])) ?>"></span>
						<? else: ?>
							<span class="image_url" itemprop="url" content="<?= SITE_URL ?>/img/logo-large.png"></span>
							<span class="image_width" itemprop="width" content="720"></span>
							<span class="image_height" itemprop="height" content="405"></span>
						<? endif; ?>
						</li>
					</ul>

					<? if($item["html"]): ?>
					<div class="articlebody" itemprop="articleBody">
						<?= $item["html"] ?>
					</div>
					<? endif; ?>

				</li>
			<? endforeach; ?>
			</ul>

		</div>
		<? endif; ?>

	</div>

	<? endforeach; ?>

<? else: ?>

	<h3>Din bruger har ikke tilladelse til at se denne side.</h3>

<? endif; ?>

</div>