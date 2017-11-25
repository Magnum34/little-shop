<?php


/**
 * Description of ProductPage
 *
 * @author Magnum34
 */
class ProductPage extends Page {

	private static $singular_name  = "Product";
    
	private static $plural_name  = "Products";

	private static $can_be_root = false;

	private static $allowed_children = 'none';

	private static $db = array(
		"Title" => "Varchar(200)",
		"SKU" => "Varchar(255)",
		"Content" => "HTMLText",
		"Created" => "SS_Datetime",
		"Price" => "Currency(19,4)",
		"Popularity" => "Int"
	);

//	private static $many_many = array(
//		"ProductTag" => "ProductTag",
//		"Images" => "Image"
//	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}

}

class ProductPage_Controller extends Page_Controller {
	
}
