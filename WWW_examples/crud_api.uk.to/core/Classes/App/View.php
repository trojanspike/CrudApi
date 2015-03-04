<?php namespace App;

use App\Config;

class View {
    
    public static function getJS($path){
        $output = "";
        $AppJs = glob($path.'/*.js');
        $AppJs = array_merge($AppJs , glob($path.'/**/**/*.js'));
        foreach($AppJs as $js){
            $js = preg_replace("/.*www(.*)$/", "$1", $js);
            echo "<script type='text/javascript' src='{$js}'></script>";
        }
    }
    
}

?>