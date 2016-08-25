Util.Objects["front"] = new function() {
	this.init = function(scene) {
//		u.bug("scene init:" + u.nodeId(scene))

		scene.resized = function() {
//			u.bug("scene.resized:" + u.nodeId(this));

		}

		scene.scrolled = function() {
//			u.bug("scrolled:" + u.nodeId(this))
		}

		scene.ready = function() {
//			u.bug("scene.ready:" + u.nodeId(this));

			// map reference
			page.cN.scene = this;

			this.client_tabs = u.qsa("ul.clients li", this);
			if(this.client_tabs.length) {
				var i, tab;
				for(i = 0; tab = this.client_tabs[i]; i++) {
					tab.scene = this;
					tab.i = i;

					tab.pane = u.qs("#" + tab.getAttribute("data-tab"));
					tab.pane.scene = this;
					tab.pane.tab = tab;

					u.ce(tab);
					tab.clicked = function() {
						this.scene.selectTab(this);
					}
				}

				this.selectTab = function(selected_tab) {

					u.saveCookie("selected-tab", selected_tab.i);

					var i, tab;
					for(i = 0; tab = this.client_tabs[i]; i++) {
						u.rc(tab, "selected");
						u.ass(tab.pane, {
							"display":"none"
						})
					}

					u.ac(selected_tab, "selected");
					u.ass(selected_tab.pane, {
						"display":"block"
					})
				}

				var selected_tab = u.getCookie("selected-tab");
				if(!selected_tab) {
					selected_tab = 0;
				}
				// select first tab
				this.selectTab(this.client_tabs[selected_tab]);
			}
			else {
				
				var first_client = u.qs("div.client", this);
				u.ass(first_client, {
					"display":"block"
				})
			}

		}




		// scene is ready
		scene.ready();

	}

}
