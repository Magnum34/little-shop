<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-19
 * Time: 16:33
 */


//TODO: for search category and Tags, Atrribute, Kinds
class URLSegmentField
{

    private $prefix = null;

    private $name_search = null;

    private $search = false;

    public function __construct($prefix = null, $search = false)
    {
        $this->prefix = $prefix;
        $this->search = $search;
    }

    /**
     *
     * generate link search tags, category, atrributes
     * @param $name_search - name search
     */
    public function setSearchName($name_search)
    {
        $this->name_search = $name_search;
        $this->search = true;
    }

    public function getURLEditField()
    {
        if (class_exists('SiteTreeURLSegmentField')) {
            $shop = DataObject::get_one("ProductsPage");
            if($this->search && $this->name_search ) {
                $baseLink = Controller::join_links(
                    Director::absoluteBaseURL(),
                    $shop->URLSegment,
                    'search?'.$this->name_search.'='
                );

            }elseif($this->prefix && $shop){
                $baseLink = Controller::join_links(
                    Director::absoluteBaseURL(),
                    $shop->URLSegment,
                    $this->prefix
                );
            }else {
                $baseLink = Controller::join_links(
                    Director::absoluteBaseURL()
                );
            }

            $url_field = SiteTreeURLSegmentField::create("URLSegment");
            $url_field->setURLPrefix($baseLink);
        } else {
            $url_field = TextField::create("URLSegment");
        }
        return $url_field;
    }

}