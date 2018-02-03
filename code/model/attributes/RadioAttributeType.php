<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:16
 */

class RadioAttributeType extends AttributeType
{
    private static $singular_name     = "Radio Attribute";

    private static $plural_name       = "Radio Attributes";

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