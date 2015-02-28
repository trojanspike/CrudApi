<?php

class Rest {
    
    private static $_Policies, $_params, $_api;
    public static $Dir, $debug = false;
    
    public static function init($parts)
    {
        static::$Dir = realpath(static::$Dir);

        static::$_api = $parts[0];
        Api::inject('API', $parts[0]);
        unset($parts[0]);
        Api::inject('PARAMS', array_values($parts));
        static::$_Policies = static::_RequireOrError(static::$Dir.'/config/Policies.php');
        
        static::_RequireOrError(static::$Dir.'/api/'.static::$_api.'.php');
        static::_RequireOrError(static::$Dir.'/config/Injects.php');

        if( ! in_array(static::$_api , array_keys(static::$_Policies)) )
        {
            /* Auth required by default */
            static::_RequireOrError(static::$Dir.'/config/Auth.php');
            
        } else {
            static::_AuthChecker();
        }
    }
    
    private static function _RequireOrError($path){
        if( file_exists($path) ){
            return require_once($path);
        } else {
            if( static::$debug ){
                echo json_encode([
                        "error" => "fileNotFound",
                        "path" => $path,
                        "policies" => static::$_Policies
                    ]);
                exit();
            }
        }
    }
    
    private static function _AuthChecker()
    {
        $policy = static::$_Policies[static::$_api];
        if( $policy === false ){
            /* No auth required */
            static::_RequireOrError( static::$Dir.'/config/NoAuth.php' );
        } else {
            if( is_array($policy) && in_array($_SERVER['REQUEST_METHOD'] , $policy) ){
                static::_RequireOrError( static::$Dir.'/config/NoAuth.php' );
            } else {
                static::_RequireOrError( static::$Dir.'/config/Auth.php' );
            }
        }
    }
    
}

?>