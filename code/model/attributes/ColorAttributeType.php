<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:36
 */

class ColorAttributeType extends AttributeType
{
    private static $singular_name     = "Color Attribute";

    private static $plural_name       = "Color Attributes";

    private static $has_many = array(
        "ColorAttributeValues" => "ColorAttributeValue"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        return $fields;

    }
}