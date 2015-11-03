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
    public static function getJS($path) /* TODO , if in production run through uglify & cache */
    {   /* TODO , refactor to scale ? */
        $AppJs = glob($path.'/*.js');
        $time = time();
        $AppJs = array_merge($AppJs , glob($path.'/**/**/*.js'));
        foreach($AppJs as $js)
        {
            $js = preg_replace("/.*www(.*)$/", "$1", $js);
            echo "<script type='text/javascript' src='{$js}?v={$time}'></script>";
        }
    }
    
}

?>