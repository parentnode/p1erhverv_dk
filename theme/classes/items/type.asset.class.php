<?php
/**
* @package janitor.items
* This file contains item type functionality
*/

class TypeAsset extends Itemtype {

	/**
	* Init, set varnames, validation rules
	*/
	function __construct() {

		// construct ItemType before adding to model
		parent::__construct(get_class());

		// itemtype database
		$this->db = SITE_DB.".item_asset";

		// Name
		$this->addToModel("name", array(
			"type" => "string",
			"label" => "Name",
			"required" => true,
			"unique" => $this->db,
			"hint_message" => "Asset handler", 
			"error_message" => "Name must to be unique."
		));

		// Mediae
		$this->addToModel("mediae", array(
			"type" => "files",
			"label" => "Add media here",
			"max" => 20,
			"allowed_formats" => "pdf",
			"hint_message" => "Add assets here. Use pdf.",
			"error_message" => "Invalid asset.",
		));

	}

}

?>
