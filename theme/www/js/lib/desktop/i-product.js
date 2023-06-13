Util.Modules["product"] = new function() {
	this.init = function(div) {


		div._text = u.wc(div, "div", {"class":"text"});

		div._item_id = u.cv(div, "id");
		div._variant = u.cv(div, "variant");
		div._format = u.cv(div, "format");

		div._image = u.ie(div, "div", {"class":"image"});
		u.ie(div._image, "img", {"src":"/images/"+div._item_id+"/"+div._variant+"/480x480."+div._format});


	}
}