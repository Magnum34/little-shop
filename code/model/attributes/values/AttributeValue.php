<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 22:35
 */

class AttributeValue extends DataObject
{
    private static $singular_name     = "Value Attribute";

    private static $plural_name       = "Values Attribute";

    private static $db = array(
        "Value" => "Varchar(200)",
        "URLSegment" => "Varchar(255)",
        "Sort" => "Int"
    );

    private static $has_one = array(
        "CheckboxAttributeType" => "CheckboxAttributeType",
        "RadioAttributeType" => "RadioAttributeType",
        "SelectAttributeType" => "SelectAttributeType",
        "FromToAttributeType" => "FromToAttributeType"
    );

    private static $indexes = array(
        "URLSegment" => true,
    );

    private static $field_labels = array(
        'URLSegment' => 'URL'
    );

    private static $default_sort = '"Sort" ASC';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName("Sort");
        return $fields;

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
            if (!$t || $t == '-' || $t == '-1') $t = "value-$this->ID";

            // Hook for extensions
            $this->extend('updateURLSegment', $t, $title);
            $this->URLSegment = $t;
            $generate =  new GeneratorURLSegment($this,$this->URLSegment);
            $generate->UniqueURLSegment();
            $this->URLSegment = $generate->getURLSegment();
        }

    }
}