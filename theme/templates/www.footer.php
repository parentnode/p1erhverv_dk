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
						<li class="streetaddress" itemprop="streetAddress">Stejlhøj 46</li>
						<li class="city"><span class="postal" itemprop="postalCode">4400</span> <span class="locality" itemprop="addressLocality">Kalundborg</span></li>
						<li class="country" itemprop="addressCountry"></li>
					</ul>
				</dd>
				<dt class="cvr">CVR</dt>
				<dd class="cvr" itemprop="taxID">31 58 90 45</dd>
			</dl>

			<dl class="info contact">
				<dt class="contact">Kontakt os</dt>
				<dd class="contact">
					<ul>
						<li class="email"><a href="mailto:punkt1@p1erhverv.dk" itemprop="email" content="punkt1@p1erhverv.dk">punkt1@p1erhverv.dk</a></li>
						<li class="tel"><a href="callto:+4538404065" itemprop="tel" content="+4570205200">+45 38 40 40 65</a></li>
					</ul>
				</dd>
			</dl>
		</div>
	</div>

</div>

</body>
</html>