Util.Objects["page"] = new function() {
	this.init = function(page) {

		// header reference
		page.hN = u.qs("#header");

		// content reference
		page.cN = u.qs("#content", page);

		// navigation reference
		page.nN = u.qs("#navigation", page);
		page.nN = u.ie(page.hN, page.nN);

		// footer reference
		page.fN = u.qs("#footer");


		page.logo = u.ae(page.hN, "div", {"class":"logo", "html":"Punkt1, Erhverv"});
		u.ce(page.logo);
		page.logo.clicked = function() {
			location.href = "/";			
		}
		


		// global resize handler 
		page.resized = function() {
//			u.bug("page.resized:" + u.nodeId(this));

			page.browser_w = u.browserW();
			page.browser_h = u.browserH();

			// declare fixed width
			if(page.browser_w > 960) {
				u.ac(document.body, "fixed");
			}
			else {
				u.rc(document.body, "fixed");
			}

			// forward scroll event to current scene
			if(page.cN && page.cN.scene && typeof(page.cN.scene.resized) == "function") {
				page.cN.scene.resized();
			}
		}

		// global scroll handler 
		page.scrolled = function() {
//			u.bug("page.scrolled:" + u.nodeId(this))

			// forward scroll event to current scene
			if(page.cN && page.cN.scene && typeof(page.cN.scene.scrolled) == "function") {
				page.cN.scene.scrolled();
			}
		}

		// Page is ready
		page.ready = function() {
//			u.bug("page.ready:" + u.nodeId(this));

			// page is ready to be shown - only initalize if not already shown
			if(!this.is_ready) {

				// page is ready
				this.is_ready = true;

				// set resize handler
				u.e.addEvent(window, "resize", page.resized);
				// set scroll handler
				u.e.addEvent(window, "scroll", page.scrolled);
				// set orientationchange handler
				u.e.addEvent(window, "orientation", page.orientationchanged);

				// Initialize header
				this.initHeader();

				// initial page re-calculation
				page.resized();
			}

		}

		// initialize header
		page.initHeader = function() {


		}

		// ready to start page builing process
		page.ready();
	}
}

u.e.addDOMReadyEvent(u.init);
