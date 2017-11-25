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
        $obj_url = new URLSegmentField();
        $url_field = $obj_url->getURLEditField();
        $fields->addFieldsToTab("Root.Main",$url_field);
        $fields->addFieldsToTab("Root.Main", TagField::create("ProductTags", "Tags", ProductTag::get(), $this->ProductTags())
            ->setShouldLazyLoad(true)
            ->setCanCreate(true)
            ,"Content");
        //images
        $fields->addFieldsToTab("Root.Images",$this->getGridFieldImages());



        return $fields;
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