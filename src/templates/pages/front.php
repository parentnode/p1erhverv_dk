<?
$IC = new Items();
$itemtype = "client";
$typeClient = $IC->typeObject($itemtype);

// get clients for current user
$clients = $typeClient->getClients();

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


		<? $items = $typeClient->getProducts($client["id"]); ?>
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