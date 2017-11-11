<?php

class ProductCategory extends DataObject {

	private static $default_sort = '"Sort" ASC';
	private static $db = array(
		"Name" => "Varchar(255)",
		"URLSegment" => "Varchar(255)",
		"ShortDescription" => "Text",
		"Sort" => "Int"
	);
	private static $has_one = array(
		"Parent" => "ProductCategory",
		"CategoryImage" => "Image"
	);

	private static $extensions = array(
        "Hierarchy"
    );

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName("Sort");
		$fields->removeByName("URLSegment");
		if ($this->exists()) {
			$configField = GridFieldConfigCategory::create($this->ClassName);
			$child_edit = $configField->getComponentByType('GridFieldDetailForm');


			//Save Object Children ParentID
            $self = $this;
            $child_edit->setItemEditFormCallback(function($form, $itemRequest) use ($self) {
                $record = $form->getRecord();
                if (!$record->ID) {
                    $parent_field = $form->Fields()->dataFieldByName("ParentID");
                    $parent_field->setValue($self->ID);
                }
            });
			$GridField = new GridField("Children", "Children", ProductCategory::get()->filter("ParentID", $this->ID), $configField);
			$fields->addFieldToTab("Root.Children", $GridField);
		}



		return $fields;
	}

}
