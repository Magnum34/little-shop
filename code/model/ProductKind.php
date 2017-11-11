<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-11
 * Time: 20:07
 */

class ProductKind extends DataObject {

    private static $default_sort = '"Sort" ASC';

    private static $db = array(
        "Name" => "Varchar(255)",
        "URLSegment" => "Varchar(255)",
        "ShortDescription" => "Text",
        "Sort" => "Int"
    );
    private static $has_one = array(
        "Parent" => "ProductKind",
        "KindImage" => "Image"
    );

    private static $extensions = array(
        "Hierarchy"
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        return $fields;
    }

}