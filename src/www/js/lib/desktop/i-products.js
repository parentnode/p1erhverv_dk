Util.Objects["products"] = new function() {
	this.init = function(div) {


		div.ul_products = u.qs("ul.products", div);


		var tags = u.qsa("li.tag", div.ul_products);
		if(tags) {
			div._filter = u.ae(div, "div", {"class":"filter"});
			div._filter = div.insertBefore(div._filter, div.ul_products);
			div._filter.div = div;

			div._filter.checkTags = function(node) {

				if(this.selected_tag) {
//					u.bug("checkTags selected_tag:" + this.selected_tag);

					var regex = new RegExp("(^|\b|;)"+this.selected_tag, "g");
					u.bug(node._c);
					u.bug(node._c.match(regex));
					if(!node._c.match(regex)) {
						return false;
					}
				}

				return true;
			}

			div._filter.filterItems = function() {
				u.bug("selected_tag:" + this.selected_tag);
				var i, node;
				if(this.current_filter != this.selected_tag) {

					this.current_filter = this.selected_tag;
					for(i = 0; node = this.div.products[i]; i++) {

						if(this.checkTags(node)) {
							u.as(node, "display", "inline-block", false);
						}
						else {
							u.as(node, "display", "none", false);
						}
					}

				}

				u.rc(this, "filtering");

			}


			var i, node, tag, li, used_tags = [];
			var instant_delivery = false;

			div._filter._tags = u.ie(div._filter, "ul", {"class":"tags"});

			for(i = 0; node = tags[i]; i++) {

				tag = u.text(node);
				if(tag == "Strakslevering") {
					instant_delivery = true;
				}
				else if(used_tags.indexOf(tag) == -1) {
					used_tags.push(tag);
				}

			}
			used_tags.sort();

			// inject "all" filter
			li = u.ae(div._filter._tags, "li", {"class":"selected", "html":"Alle"});
			li._filter = div._filter;
			u.e.click(li);
			li.clicked = function(event) {
				this._filter.selected_tag = "";

				var i, node;
				for(i = 0; node = this._filter.tags[i]; i++) {
					u.rc(node, "selected");
				}

				u.ac(this, "selected");

				// update list filtering
				this._filter.filterItems();
			}

			if(instant_delivery) {
				li = u.ae(div._filter._tags, "li", {"html":"Strakslevering", "class":"instant"});
				li._filter = div._filter;
				u.e.click(li);
				li.clicked = function(event) {
					this._filter.selected_tag = "strakslevering";

					var i, node;
					for(i = 0; node = this._filter.tags[i]; i++) {
						u.rc(node, "selected");
					}

					u.ac(this, "selected");

					// update list filtering
					this._filter.filterItems();
				}
			}

			for(i = 0; tag = used_tags[i]; i++) {
				li = u.ae(div._filter._tags, "li", {"html":tag});
				li.tag = tag.toLowerCase();
				li._filter = div._filter;

				u.e.click(li);
				li.clicked = function(event) {
					this._filter.selected_tag = "";

					var i, node;
					for(i = 0; node = this._filter.tags[i]; i++) {
						u.rc(node, "selected");
					}

					this._filter.selected_tag = this.tag;
					u.ac(this, "selected");

					// update list filtering
					this._filter.filterItems();
				}

			}
			div._filter.tags = u.qsa("li", div._filter._tags);
			div._filter.selected_tags = [];

		}

		div.products = u.qsa("li.product", div.ul_products);
		var i, node;
		for(i = 0; node = div.products[i]; i++) {

			node._c = "";

			var text_nodes = u.qsa("h2,h3,h4,h5,p,ul.info,dl,li.tag", node);
			for(j = 0; text_node = text_nodes[j]; j++) {
				node._c += u.text(text_node).toLowerCase().replace(/[ \t\n\r]+/g, " ") + ";";
			}

//			u.bug("_c" + node._c)
			node._item_id = u.cv(node, "id");
			node._variant = u.cv(node, "variant");
			node._format = u.cv(node, "format");

			node._image = u.ie(node, "div", {"class":"image"});
			if(node._format && node._variant && node._item_id) {
				u.ae(node._image, "img", {"src":"/images/"+node._item_id+"/"+node._variant+"/480x480."+node._format});
			}
			else {
				u.ae(node._image, "img", {"src":"/images/0/missing/480x480.png"});
			}


			if(u.hc(node, "instant")) {
				u.ae(node._image, "div", {"class":"banner", "html":"Straks-levering"});
			}

//			u.ce(node, {"type":"link"});

		}


	}
}