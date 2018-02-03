<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:18
 */

class FromToAttributeType extends AttributeType
{
    private static $singular_name     = "From To Attribute";

    private static $plural_name       = "From To Attributes";

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