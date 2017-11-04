<?php

class Category extends DataObject {

	private static $default_sort = '"Sort" ASC';
	private static $db = array(
		"Name" => "Varchar(255)",
		"URLSegment" => "Varchar(255)",
		"ShortDescription" => "Text",
		"Sort" => "Int"
	);
	private static $has_one = array(
		"Parent" => "Category",
		"CategoryImage" => "Image"
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Sort");
		$fields->removeByName("URLSegment");
		$fields->removeByName("ParentID");

		return $fields;
	}

}
