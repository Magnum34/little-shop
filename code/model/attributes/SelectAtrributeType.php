<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 21:51
 */

class SelectAtrributeType extends AttributeType
{
    private static $singular_name     = "Select Attribute";

    private static $plural_name       = "Select Attributes";

    private static $has_many = array(
        "AttributeValues" => "AttributeValue"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        return $fields;

    }

}