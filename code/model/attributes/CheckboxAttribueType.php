<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:17
 */

class CheckboxAttribueType extends  AttributeType
{
    private static $singular_name     = "Checkbox Attribute";

    private static $plural_name       = "Checkobox Attributes";

    private static $has_many = array(
        "AttributeValues" => "AttributeValue"
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        $config = GridFieldConfig_RelationEditor::create();
        $GridField = new GridField("AttributeValues", "Values", $this->AttributeValues(), $config);
        $fields->addFieldToTab("Root.Values", $GridField);

        return $fields;

    }
}