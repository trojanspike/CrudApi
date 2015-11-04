<?php namespace App;

use App\Config;

/**
 * View class, render JS , HTML for one page apps
 *
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */


class View {

    /**
     * Does something interesting
     * 28/03/15 , 16:30
     * @param  string    $path  Path to where the .js file are located
     *
     * @return echo's out each JS script tag
     */
    public static function getJS()
    {
        $AppJS = [];
        foreach( path("js_dirs") as $jsdir ) /* TODO : id path(bowerFile) != false */
        {
            $AppJS = array_merge_recursive($AppJS, glob($jsdir.'/*.js'), glob($jsdir.'/**/*.js') );
        }
        foreach($AppJS as $js)
        {
            $js = preg_replace("/.*www(.*)$/", "$1", $js);
            echo "<script type='text/javascript' src='{$js}'></script>";
        }

    }

}