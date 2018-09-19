<? $navigation = $this->navigation("main"); ?>
	</div>

	<div id="navigation">
		<ul class="navigation">
		<? if($navigation && $navigation["nodes"]): ?>
			<? foreach($navigation["nodes"] as $node): ?>
			<?= $HTML->navigationLink($node); ?>
			<? endforeach; ?>
		<? endif; ?>
		</ul>
	</div>

	<div id="footer">
		<div itemtype="http://schema.org/Organization" itemscope class="vcard company">
			<h2 class="name fn org" itemprop="name">Punkt1 Erhverv</h2>

			<dl class="info basic">
				<dt class="address">Adresse</dt>
				<dd class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<ul>
						<li class="streetaddress" itemprop="streetAddress"></li>
						<li class="city"><span class="postal" itemprop="postalCode"></span> <span class="locality" itemprop="addressLocality"></span></li>
						<li class="country" itemprop="addressCountry"></li>
					</ul>
				</dd>
				<dt class="cvr">CVR</dt>
				<dd class="cvr" itemprop="taxID">25 38 00 88</dd>
			</dl>

			<dl class="info contact">
				<dt class="contact">Kontakt os</dt>
				<dd class="contact">
					<ul>
						<li class="email"><a href="mailto:sl@punkt1.dk" itemprop="email" content="sl@punkt1.dk">sl@punkt1.dk</a></li>
						<li class="tel"><a href="callto:+4570205200" itemprop="tel" content="+4570205200">+45 7020 5200</a></li>
					</ul>
				</dd>
			</dl>
		</div>
	</div>

</div>

</body>
</html>