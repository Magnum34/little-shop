<?php


class AttributeType extends DataObject
{
    private static $singular_name     = "Attribute";

    private static $plural_name       = "Attributes";

    private static $field_labels = array(
        'URLSegment' => 'URL'
    );

    private static $default_sort = '"Sort" ASC';

    private static $db = array(
        "Name" => "Varchar(255)",
        "URLSegment" => "Varchar(255)",
        "Sort" => "Int"
    );

    private static $indexes = array(
        "URLSegment" => true,
    );

    private static $summary_fields = array(
        'Name' => 'Name',
        'ClassName' => 'Type'
    );

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
            if (!$t || $t == '-' || $t == '-1') $t = "attribute-$this->ID";

            // Hook for extensions
            $this->extend('updateURLSegment', $t, $title);
            $this->URLSegment = $t;
            $generate =  new GeneratorURLSegment($this,$this->URLSegment);
            $generate->UniqueURLSegment();
            $this->URLSegment = $generate->getURLSegment();
        }

    }



}