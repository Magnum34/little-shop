<?php

/**
 * Description of ProductTag
 *
 * @author Magnum34
 */
class ProductTag extends DataObject {

    private static $field_labels = array(
        'URLSegment' => 'URL'
    );

	private static $default_sort = '"Sort" ASC';

	private static $db = array(
		"Title" => "Varchar(200)",
		"URLSegment" => "Varchar(255)",
		"Sort" => "Int"
	);

    private static $indexes = array(
        "URLSegment" => true,
    );

	private static $belong_many_many = array("Products" => "Product");

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Sort");
		$fields->removeByName("URLSegment");
        $obj_url = new URLSegmentField();
        $url_field = $obj_url->getURLEditField();
        $fields->addFieldsToTab("Root.Main",$url_field);

		return $fields;
	}


    public function getCMSValidator() {
        $validator = new TitleUniqueValidator();
        $validator->setClassNameValidator($this->ClassName);
        $validator->setObjID($this->ID);
        return $validator;
    }

    /**
     * Generarte URLSegment for Object
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        if($this->Title && !$this->URLSegment)
            $this->URLSegment =  SiteTree::generateURLSegment($this->Title);
    }


}
