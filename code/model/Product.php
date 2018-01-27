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
	
	private static $has_one = array(
		"ThumbnailImage" => "Image"
	);


    private static $belongs_many_many = array(
        "Categories" => "ProductCategory",
        "Kinds" => "ProductKind"
    );
	
	private static $many_many_extraFields = array(
        'Images' => array('SortOrder' => 'Int')
    );


    private static $indexes = array(
        "URLSegment" => true,
    );

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
        $fields->addFieldsToTab("Root.Images",  SortableUploadField::create("Images","Images"));
		$fields->addFieldsToTab("Root.Images",  UploadField::create("ThumbnailImage","Thumbnail"));


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


    /**
    * Summary the Product
    **/
    public function Summary($maxWords = 50){
        if($this->ShortDescription){
            return $this->dbObject('ShortDescription')->Summary($maxWords);
        }else{
            return $this->dbObject('Content')->Summary($maxWords);
        }

    }
	
	public function getLink(){
			return Controller::join_links(Controller::curr()->URLSegment,'details',$this->URLSegment.",".$this->ID);
	}
	
	public function getThumbnail(){
		if($this->ThumbnailImage()->exists()){
			return $this->ThumbnailImage();
		}else{
			if($this->Images()->first()){
				return $this->Images()->first();
			}
		}
		return false;
		
	}
	
	public function SortedImages(){
        return $this->Images()->Sort('SortOrder');
    }




}