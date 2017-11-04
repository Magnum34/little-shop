<?php

/**
 * Description of ProductTag
 *
 * @author Magnum34
 */
class ProductTag extends DataObject {

	private static $default_sort = '"Sort" ASC';
	private static $db = array(
		"Name" => "Varchar(200)",
		"URLSegment" => "Varchar(255)",
		"Sort" => "Int"
	);
	private static $belong_many_many = array("ProductPage" => "ProductPage");

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Sort");
		$fields->removeByName("URLSegment");
		$fields->removeByName("ProductPageID");
		return $fields;
	}

}
