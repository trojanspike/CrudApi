<?php

class Rest {
    
    private static $_Policies, $_params, $_api, $restDir;
    
    public static function init($conf)
    {
        $parts = $conf['parts'];
        static::$restDir = realpath($conf['restDir']);

        static::$_api = $parts[0];
        unset($parts[0]);
        static::$_params = array_values($paths);
        static::$_Policies = require_once static::$restDir.'/config/Policies.php';
        
        if( file_exists(static::$restDir.'/api/'.static::$_api.'.php') ){
            require_once static::$restDir.'/api/'.static::$_api.'.php';
            require_once static::$restDir.'/config/injects.php';
        } else {
            /*  Error */
            echo "error";
            exit();
        }
        
        
        if( ! in_array(static::$_api , array_keys(static::$_Policies)) )
        {
            /* Auth required by default */
            require_once static::$restDir.'/config/Auth.php';
            
        } else {
            static::_AuthChecker();
        }
    }
    
    private static function _AuthChecker()
    {
        $policy = static::$_Policies[static::$_api];
        if( $policy == false ){
            /* No auth required */
            require_once static::$restDir.'/config/noAuth.php';
        } else {
            if( is_array($policy) && in_array($_SERVER['REQUEST_METHOD'] , $policy) ){
                require_once static::$restDir.'/config/noAuth.php';
            } else {
                require_once static::$restDir.'/config/Auth.php';
            }
        }
    }
    
}

?>