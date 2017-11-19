<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-19
 * Time: 16:33
 */

class URLSegmentField
{
    public function getURLEditField(){
        if (class_exists('SiteTreeURLSegmentField')) {
            $baseLink = Controller::join_links(
                Director::absoluteBaseURL()
            );

            $url_field = SiteTreeURLSegmentField::create("URLSegment");
            $url_field->setURLPrefix($baseLink);
        } else {
            $url_field = TextField::create("URLSegment");
        }
        return $url_field;
    }

}