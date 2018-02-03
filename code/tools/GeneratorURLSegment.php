<?php

//TODO: optymalization and unique
class GeneratorURLSegment
{

    private $URLSegment;

    private $object;

    public function  __construct(DataObject $object,$URLSegment = null)
    {
        $this->URLSegment = $URLSegment;
        $this->object = $object;
    }

    public function generateURLSegment($title)
    {
        $filter = URLSegmentFilter::create();
        $t = $filter->filter($title);
        // Fallback to generic page name if path is empty (= no valid, convertable characters)
        if (!$t || $t == '-' || $t == '-1') {
            $t = "page-$this->ID";
        }
        // Hook for extensions
        $this->URLSegment = t;
    }

    public function validURLSegment()
    {

        $segment = Convert::raw2sql($this->URLSegment);
            $classname = $this->object->ClassName;
            $return = $classname::get()
                ->filter(array(
                    "URLSegment"=> $segment,
                    "ID:not"    => $this->object->ID
                ));
            if ($return->exists()) {
                return false;
            }

        return true;
    }

    public function UniqueURLSegment(){
        $this->URLSegment = preg_replace('/-[0-9]+$/', null, $this->URLSegment) . '-' . $this->object->ID;
    }

    public function getURLSegment(){
        return $this->URLSegment;
    }
}