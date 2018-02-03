<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:17
 */

class RangeAttributeType extends  AttributeType
{
    private static $singular_name     = "Range Attribute";

    private static $plural_name       = "Range Attributes";

    private static  $db = array(
        "From" => "Decimal",
        "To" => "Decimal",
        "Space" => "Decimal"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        return $fields;

    }
}