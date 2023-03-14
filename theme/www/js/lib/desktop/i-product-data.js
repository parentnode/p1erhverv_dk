Util.Objects["productData"] = new function() {
	this.init = function(div) {
		u.bug("init ", div);

		div.form = u.qs("form", div);
		u.f.init(div.form);

		div.result = u.qs("div.result");
		div.form.div = div;

		div.form.submitted = function() {

			this.response = function(response) {
				u.bug("response", response);

				response[0].productFicheFileName = "https://media.power-cdn.net"+response[0].productFicheFileName;
				response[0].productManuals[0].filepath = "https://media.power-cdn.net"+response[0].productManuals[0].filepath;

				this.div.result.innerHTML = "<pre>"+JSON.stringify(response[0], undefined, 2) + "</pre>";
				
			}
			u.request(this, "https://www.punkt1.dk/api/v2/products", {data:u.f.getParams(this)});
		}


	}
}