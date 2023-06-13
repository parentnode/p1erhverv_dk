Util.Modules["assets"] = new function() {
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

			this.assets = u.qsa("li.asset span.link_text", this);
			
			var i, asset;
			for(i = 0; i < this.assets.length; i++) {
				asset = this.assets[i];

				asset.dblclicked = function(event) {

					var sel = window.getSelection();
					var range = sel.getRangeAt(0);
					var node = sel.anchorNode;

					range.setStart(node, 0);
					range.setEnd(node, node.textContent.length);

				}

				u.e.dblclick(asset);
			}

		}


		// scene is ready
		scene.ready();
	}
}
