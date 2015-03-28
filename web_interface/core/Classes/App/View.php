<?php namespace App;

use App\Config;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license
 * @version
 * @link
 * @since
 */

class View {
    
    public static function getJS($path){
        /*
        /v1/ext-Coffee/app/pages/user/controller.coffee
        */
        $AppJs = glob($path.'/*.js');
        $time = time();
        $AppJs = array_merge($AppJs , glob($path.'/**/**/*.js'));
        foreach($AppJs as $js){
            $js = preg_replace("/.*www(.*)$/", "$1", $js);
            echo "<script type='text/javascript' src='{$js}?v={$time}'></script>";
        }
    }
    
    
    public static function renderJS($path){
        
    }
    
}

?>