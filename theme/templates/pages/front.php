<?
$IC = new Items();
$itemtype = "client";
$typeClient = $IC->typeObject($itemtype);

// get clients for current user
$clients = $typeClient->getClients();
$items = false;
$client_contexts = false;

// Client selection
$client_id = stringOr(getVar("client_id"), session()->value("client_id"));

// Pre-select first client if none is selected
if($clients && (!$client_id || arrayKeyValue($clients, "id", $client_id) === false)) {
	$client_id = $clients[0]["id"];
}

// Remember current client selection
if($client_id) {
	session()->value("client_id", $client_id);


	// get possible contexts for selected client
	$contexts = $typeClient->getContexts($client_id);
	if($contexts && $contexts["client"]) {

		$client_contexts = $contexts["client"];





		//print "client_id:" . $client_id . "<br>";

		$selected_contexts = session()->value("selected_contexts");


		// was filter value sent?
		// filter = client_id/context/tag_id
		$filter = getVar("filter");
		if($filter) {

			// split filter value into fragments
			list($filter_client_id, $filter_context, $filter_tag_id) = explode("/", $filter);

			// does context apply to this client
			$context_index = arrayKeyValue($client_contexts, "context", $filter_context);
			if($context_index !== false) {

				// update value for client/context
				$selected_contexts[$filter_client_id][$context_index] = $filter_tag_id;

				// clear any selections later in the hierachy
				// loop through selections
				if(count($selected_contexts[$filter_client_id]) > $context_index) {
					array_splice($selected_contexts[$filter_client_id], $context_index+1);
				}

			}

			// Store selection in session
			session()->value("selected_contexts", $selected_contexts);
		}

		//	print_r($selected_contexts);

	}

}



// test reset context value
//session()->reset("selected_contexts");

?>
<div class="scene front i:front">

<? if($clients): ?>

	<? if(count($clients) > 1): ?>
	<ul class="clients">
	<? foreach($clients as $client): ?>
		<li class="client<?= $client_id == $client["id"] ? " selected" : "" ?>"><a href="?client_id=<?= $client["id"] ?>"><?= $client["name"] ?></a></li>
	<? endforeach; ?>
	</ul>
	<? endif; ?>

<? endif; ?>


<? if($client_id):
	// map selected client
	$client = $clients[arrayKeyValue($clients, "id", $client_id)]; ?>


	<div class="client" id="<?= superNormalize(preg_replace("/[0-9]+/", "", $client["name"])) ?>">
		<div class="article">

			<h1><?= $client["name"] ?></h1>


			<? if($client["html"]): ?>
			<div class="articlebody">
				<?= $client["html"] ?>
			</div>
			<? endif; ?>


			<? if($client["buy_button"]): ?>
			<ul class="actions">
				<li class="buy"><a href="mailto:ole@p1erhverv.dk?subject=Rekvisition:%20[Anfør%20nummer%20her]&body=Bestilling%20modtaget%20fra%20www.p1erhverv.dk%0D%0A%0D%0AVedhæft%20rekvisition%20–%20og%20send.">Bestil nu</a></li>
			</ul>
			<? endif; ?>
		</div>

		<?
		// is there any contexts for this client
		if($client_contexts):
		?>
		<div class="contexts">
			<h2>Filtrér sortiment</h2>
			<ul class="contexts">
			<?
			// loop through contexts
			foreach($client_contexts as $index => $context):

				// get all tags with this context
				$tags = $IC->getTags(array("context" => $context["context"]));
				
				// loop through tags to check if the all have items
				
				?>
				<li class="context">
					<ul class="context_options">
						<?
						// loop through context values
						foreach($tags as $tag):
//							print_r($typeClient->getProducts($client["id"], array($tag["id"])));
							if($typeClient->getProducts($client["id"], array($tag["id"]))):
						?>
						<li class="context<?= isset($selected_contexts[$client["id"]][$index]) && $selected_contexts[$client["id"]][$index] == $tag["id"] ? " selected" : ""?>"><a href="?filter=<?= $client["id"] ?>/<?= $context["context"] ?>/<?= $tag["id"] ?>"><?= $tag["value"] ?></a></li>
						<? 
							endif;
						endforeach;
						?>
					</ul>
				</li>
				<?
				// if user didn't select a value for this context yet, then stop the loop 
				// (user must select values in specified order)
				if(!isset($selected_contexts[$client["id"]][$index])) {
					break;
				}

			endforeach;
			?>
			</ul>
		</div>

			<?

			// user has selected the same number of contexts as are available
			// ready to actually get items
			if(isset($selected_contexts[$client["id"]]) && count($client_contexts) == count($selected_contexts[$client["id"]])):
				$items = $typeClient->getProducts($client["id"], $selected_contexts[$client["id"]]);
			endif;

		// no extra client contexts
		else: 

			// just get all client items
			$items = $typeClient->getProducts($client["id"]);

		endif; 
		?>


		<? if($items): ?>

		<div class="products i:products">
			<h2>Produkter</h2>
			<ul class="items products">
			<? foreach($items as $item):
				$media = $IC->sliceMediae($item, "mediae");
			 ?>
				<li class="item product id:<?= $item["item_id"] ?><?= $HTML->jsMedia($item) ?><?= ($client["instant_delivery"] && arrayKeyValue($item["tags"], "value", "Strakslevering") !== false) ? " instant" : "" ?>" itemscope itemtype="http://schema.org/Product">

					<ul class="tags">
					<? if($item["tags"]): ?>
						<? foreach($item["tags"] as $item_tag): ?>
							<? if($item_tag["context"] == "category" && ($client["instant_delivery"] || $item_tag["value"] != "Strakslevering")): ?>
						<li itemprop="category" class="tag"><?= $item_tag["value"] ?></li>
							<? endif; ?>
						<? endforeach; ?>
					<? endif; ?>
					</ul>

					<h3 itemprop="headline"><?= $item["name"] ?></h3>

					<? if($client["show_price"] && $item["price"]): ?>
					<div class="price">
						<dl>
							<dt>Pris</dt>
							<dd><?= $item["price"] ?></dd>
						</dl>
					</div>
					<? endif; ?>

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

<? else: ?>

	<h3>Du har ikke tilladelse til at se denne side. Kontakt <a href="mailto:ole@p1erhverv.dk" content="ole@p1erhverv.dk">ole@p1erhverv.dk</a> for mere information.</h3>

<? endif; ?>

</div>