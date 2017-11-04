<?php


/**
 * Description of ProductTag
 *
 * @author Magnum34
 */
class ProductTag extends DataObject {

	private static $db = array(
		"Name" => "Varchar(200)",
		"Sort" => "Int"
	);
	private static $belong_many_many = array("ProductPage" => "ProductPage");

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

}
