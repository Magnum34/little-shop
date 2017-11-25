<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-11
 * Time: 20:07
 */

class ProductKind extends DataObject {


    private static $field_labels = array(
        'URLSegment' => 'URL'
    );

    private static $default_sort = '"Sort" ASC';

    private static $db = array(
        "Name" => "Varchar(255)",
        "URLSegment" => "Varchar(255)",
        "ShortDescription" => "Text",
        "Sort" => "Int"
    );

    private static $many_many = array(
        "Products" => "Product"
    );

    private static $has_one = array(
        "Parent" => "ProductKind",
        "KindImage" => "Image"
    );

    private static $indexes = array(
        "URLSegment" => true,
    );

    private static $extensions = array(
        "Hierarchy"
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");


        $obj_url = new URLSegmentField();
        $url_field = $obj_url->getURLEditField();
        $fields->addFieldsToTab("Root.Main",$url_field);
        if ($this->exists()) {
            $configField = GridFieldConfigItem::create($this->ClassName);
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
        if($this->Name && !$this->URLSegment) {
            $name = $this->Name;
            $filter = URLSegmentFilter::create();
            $t = $filter->filter($name);

            // Fallback to generic page name if path is empty (= no valid, convertable characters)
            if (!$t || $t == '-' || $t == '-1') $t = "kind-$this->ID";

            // Hook for extensions
            $this->extend('updateURLSegment', $t, $name);
            $this->URLSegment = $t;
        }

    }

    public function onBeforeDelete()
    {
        parent::onBeforeDelete();

        if ($this->Children()) {
            foreach ($this->Children() as $child) {
                $child->delete();
            }
        }
    }

}