<?php


class Category extends DataObject {

	private static $db = array(
		"Name" => "Varchar(255)",
		"ShortDescription" => "Text",
		"Sort" => "Int"
	);
	private static $has_one = array(
		"Parent" => "Category",
		"CategoryImage" => "Image"
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}

}
