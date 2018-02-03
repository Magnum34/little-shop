<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2018-02-03
 * Time: 20:35
 */

class URLTool
{

    public static function ParserVars($name,array $vars) {
        $list = '';
        foreach ($vars as $key => $value) {
            if ("url" != $key && $name != $key) {
                $list .= '&' . $key . '=' . $value;
            }
        }
        return $list;
    }
}