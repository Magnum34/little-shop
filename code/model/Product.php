<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-19
 * Time: 02:29
 */

class Product extends DataObject {

    private static $field_labels = array(
        'URLSegment' => 'URL'
    );

    private static $default_sort = '"Sort" ASC';

    private static $db = array(
        "Title" => "Varchar(255)",
        "StockID" => "Varchar(255)",
        "URLSegment" => "Varchar(255)",
        "ShortDescription" => "Text",
        "Content" => "HTMLText",
        "Sort" => "Int"
    );

    private static $many_many  =array(
        "Images" => "Image",
        "ProductTags" => "ProductTag"
    );

    private static $belongs_many_many = array(
        "Categories" => "ProductCategory",
        "Kinds" => "ProductKind"
    );

    private static $indexes = array(
        "URLSegment" => true,
    );


    public function getGridFieldImages(){
        $config =  GridFieldConfig_RecordEditor::create(25);
        $config->addComponent(new GridFieldBulkUpload());
        $config->addComponent(new GridFieldOrderableRows());
        $gridFieldImage = new GridField("Images","Images",$this->Images(),$config);
        return $gridFieldImage;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        $fields->removeByName("ProductTags");
        $fields->removeByName("Categories");
        $fields->removeByName("Kinds");

        $obj_url = new URLSegmentField();
        $url_field = $obj_url->getURLEditField();
        $fields->addFieldsToTab("Root.Main",$url_field);
        $fields->addFieldsToTab("Root.Main", TagField::create("ProductTags", "Tags", ProductTag::get(), $this->ProductTags())
            ->setShouldLazyLoad(true)
            ->setCanCreate(true)
            ,"Content");
        //categories and Kinds
        $fields->addFieldsToTab("Root.CategoriesAndKinds", TreeMultiselectField::create("Categories","Categories","ProductCategory"));
        $fields->addFieldsToTab("Root.CategoriesAndKinds", TreeMultiselectField::create("Kinds","Kinds","ProductKind"));
        //images
        $fields->addFieldsToTab("Root.Images",$this->getGridFieldImages());


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
        if($this->Title && !$this->URLSegment) {
            $title = $this->Title;
            $filter = URLSegmentFilter::create();
            $t = $filter->filter($title);

            // Fallback to generic page name if path is empty (= no valid, convertable characters)
            if (!$t || $t == '-' || $t == '-1') $t = "product-$this->ID";

            // Hook for extensions
            $this->extend('updateURLSegment', $t, $title);
            $this->URLSegment = $t;
        }

    }




}