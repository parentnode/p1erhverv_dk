
// generic 
Util.Modules["activeProducts"] = new function() {
	this.init = function(div) {

		var div_products = u.qs("div.products");

		div.div_inactive = u.qs("div.all_items.inactive", div_products);
		div.list = u.qs("ul.items", div);

		div.url_remove_product = div.getAttribute("data-item-remove");
//		div.csrf_token = div.getAttribute("data-csrf-token");

		div.addProduct = function(node) {

//			u.bug("add this product:" + u.nodeId(node))

			var inactive_node = false;

			// node comming from inactive list
			if(node.parentNode == this.div_inactive.list) {
				
				inactive_node = true;

				node = u.ie(this.list, node.cloneNode(true));
				node._item_id = u.cv(node, "id");
				node.div = this;
				u.rc(node, "active");
				var actions = u.qs("ul.actions", node);
				if(actions) {
					node.removeChild(actions);
				}

				// get text content for filter
				node._c = u.text(node).toLowerCase().trim();
			}




			// basic initialization
			var actions = u.ae(node, "ul", {"class":"actions"});
			var li = u.ae(actions, "li", {"class":"remove"});
			var bn_remove = u.ae(li, "a", {"class":"button", "html":"Remove"});
			bn_remove.node = node;

			u.ce(bn_remove);
			bn_remove.clicked = function(event) {
//				u.bug("remove product")

				this.response = function(response) {
					page.notify(response);

					if(response && response.cms_status == "success") {

						this.node.parentNode.removeChild(this.node);
						var inactive_node = u.ge("id:"+this.node._item_id);
						console.log(inactive_node)
						u.rc(inactive_node, "active");

						this.node.div.nodes = u.qsa("li.item", this.node.div);
					}

				}
						console.log(this.node)

				u.request(this, this.node.div.url_remove_product+"/"+this.node._item_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});
			}

			// extra tasks when adding inactive nodes
			if(inactive_node) {
				node.div.nodes = u.qsa("li.item", node.div);
				u.defaultSortableList(node.div.list);
				node.div.list.dropped();
			}
		}

		var i, node, actions;
		for(i = 0; node = div.nodes[i]; i++) {

			div.addProduct(node);

		}


	

	}
}


Util.Modules["inactiveProducts"] = new function() {
	this.init = function(div) {

//		u.bug("inactive products:" + div.nodes.length)

		var div_products = u.qs("div.products");

		div.div_active = u.qs("div.all_items.active", div_products);
		div.list = u.qs("ul.items", div);


		div.url_add_product = div.getAttribute("data-item-add");
//		div.csrf_token = div.getAttribute("data-csrf-token");

		var i, node, actions;
		for(i = 0; node = div.nodes[i]; i++) {

			var actions = u.ae(node, "ul", {"class":"actions"});
			var li = u.ae(actions, "li", {"class":"add"});
			var bn_add = u.ae(li, "a", {"class":"button primary", "html":"Add"});
			bn_add.node = node;

			u.ce(bn_add);
			bn_add.clicked = function(event) {
				if(!u.hc(this.node, "active")) {
//					u.bug("add product")

					this.response = function(response) {
						page.notify(response);

						if(response && response.cms_status == "success") {
							u.ac(this.node, "active");

							this.node.div.div_active.addProduct(this.node);
						}

					}

					u.request(this, this.node.div.url_add_product+"/"+this.node._item_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});
				}
			}

		}


	}
}

Util.Modules["clientUsers"] = new function() {
	this.init = function(div) {

		div.url_add_user = div.getAttribute("data-item-add");
		div.url_remove_user = div.getAttribute("data-item-remove");
		div.csrf_token = div.getAttribute("data-csrf-token");

		div.users = u.qsa("li.user", div);
		var i, node;
		for(i = 0; node = div.users[i]; i++) {

			node.div = div;
			node.user_id = u.cv(node, "user_id");
			u.wc(node, "label", {"for":"user_"+node.user_id});

			var input = u.ie(node, "input", {"type":"checkbox", "id":"user_"+node.user_id});
			input.node = node;
			if(u.hc(node, "selected")) {
				input.checked = true;
			}
			input.onchange = function() {
				if(this.checked) {

					this.response = function(response) {
						page.notify(response);

						if(!response || response.cms_status != "success") {
							this.checked = false;
						}
						
					}
					u.request(this, this.node.div.url_add_user+"/"+this.node.user_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});
				}
				else {
					this.response = function(response) {
						page.notify(response);

						if(!response || response.cms_status != "success") {
							this.checked = true;
						}
						
					}
					u.request(this, this.node.div.url_remove_user+"/"+this.node.user_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});

					u.bug("remove user:" + this.node.user_id);
				}


			}

		}
		
	}
}


// generic 
Util.Modules["activeContexts"] = new function() {
	this.init = function(div) {


		var div_contexts = u.qs("div.contexts");

		div.div_inactive = u.qs("div.all_items.inactive", div_contexts);
		div.list = u.qs("ul.items", div);

		div.url_remove_context = div.getAttribute("data-item-remove");
//		div.csrf_token = div.getAttribute("data-csrf-token");

		div.addContext = function(node) {

//			u.bug("add this product:" + u.nodeId(node))

			var inactive_node = false;

			// node comming from inactive list
			if(node.parentNode == this.div_inactive.list) {
				
				inactive_node = true;

				node = u.ie(this.list, node.cloneNode(true));
				node._item_id = u.cv(node, "item_id");
				node.div = this;
				u.rc(node, "active");
				var actions = u.qs("ul.actions", node);
				if(actions) {
					node.removeChild(actions);
				}

				// get text content for filter
				node._c = u.text(node).toLowerCase().trim();
			}




			// basic initialization
			var actions = u.ae(node, "ul", {"class":"actions"});
			var li = u.ae(actions, "li", {"class":"remove"});
			var bn_remove = u.ae(li, "a", {"class":"button", "html":"Remove"});
			bn_remove.node = node;

			u.ce(bn_remove);
			bn_remove.clicked = function(event) {
//				u.bug("remove product")

				this.response = function(response) {
					page.notify(response);

					if(response && response.cms_status == "success") {

						this.node.parentNode.removeChild(this.node);

						var inactive_node = u.ge("item_id:"+this.node._item_id);
						u.rc(inactive_node, "active");

						this.node.div.nodes = u.qsa("li.item", this.node.div);
					}

				}

				u.request(this, this.node.div.url_remove_context+"/"+this.node._item_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});
			}

			// extra tasks when adding inactive nodes
			if(inactive_node) {
				node.div.nodes = u.qsa("li.item", node.div);
				u.defaultSortableList(node.div.list);
				node.div.list.dropped();
			}
		}

		var i, node, actions;
		for(i = 0; node = div.nodes[i]; i++) {

			div.addContext(node);

		}


	

	}
}


Util.Modules["inactiveContexts"] = new function() {
	this.init = function(div) {

//		u.bug("inactive contexts:" + div.nodes.length)
		var div_contexts = u.qs("div.contexts");

		div.div_active = u.qs("div.all_items.active", div_contexts);
		div.list = u.qs("ul.items", div);


		div.url_add_context = div.getAttribute("data-item-add");
//		div.csrf_token = div.getAttribute("data-csrf-token");

		var i, node, actions;
		for(i = 0; node = div.nodes[i]; i++) {

			var actions = u.ae(node, "ul", {"class":"actions"});
			var li = u.ae(actions, "li", {"class":"add"});
			var bn_add = u.ae(li, "a", {"class":"button primary", "html":"Add"});
			bn_add.node = node;

			u.ce(bn_add);
			bn_add.clicked = function(event) {
				if(!u.hc(this.node, "active")) {
//					u.bug("add context")

					this.response = function(response) {
						page.notify(response);

						if(response && response.cms_status == "success") {
							u.ac(this.node, "active");

							this.node.div.div_active.addContext(this.node);
						}

					}

					u.request(this, this.node.div.url_add_context+"/"+this.node._item_id, {"method":"post", "params":"csrf-token="+this.node.div.csrf_token});
				}
			}

		}


	}
}