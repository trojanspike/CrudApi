<?php

/** Api github.com/trojanspike/BasicAuthCRUD-api
*
* Copyright (c) 2015 Lee Mc Kay (http://www.@site/)
*
* Licensed under The MIT License
* 
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*
* @copyright Copyright 2015 (c) Lee Mc Kay (http://www.@site/)
* @link http://www.@site/
* @version 0.1.27
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

class Rest {
    
    private static $_Policies, $_params, $_api;
    public static $Dir, $debug = false;
    
    public static function init( array $parts)
    {
		if( is_dir(static::$Dir) )
        {
			static::$Dir = realpath(static::$Dir);
		}
        else
        {
			if( static::$debug )
            {
				echo json_encode([
                     "error" => "DirectoryNotFound",
                     "path" => static::$Dir
                 ]);
             exit();
			}
			static::$Dir = realpath( __DIR__.'/rest/' );
		}
        
        
        static::$_api = str_replace('-','/',$parts[0]);

        Api::inject('API', $parts[0]);

        unset($parts[0]);

        Api::inject('PARAMS', array_values($parts));

        static::$_Policies = static::_RequireOrError(static::$Dir.'/config/Policies.php');
        
        static::_RequireOrError(static::$Dir.'/api/'.static::$_api.'.php');
        static::_RequireOrError(static::$Dir.'/config/Injects.php');

        /*
        if in->array $API.$parts[0]
        i.e : /user/creste > user.create
        */
        if( ! in_array(static::$_api , array_keys(static::$_Policies)) )
        {
            /* Auth required by default */
            static::_RequireOrError(static::$Dir.'/config/Auth.php');
            
        }
        else
        {
            static::_AuthChecker();
        }
    }
    
    private static function _RequireOrError($path)
    {
        if( file_exists($path) )
        {
            return require_once($path);
        }
        else
        {
            if( static::$debug )
            {
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
        if( $policy === false )
        {
            /* No auth required */
            static::_RequireOrError( static::$Dir.'/config/NoAuth.php' );
        }
        else
        {
            if( is_array($policy) && in_array($_SERVER['REQUEST_METHOD'] , $policy) )
            {
                static::_RequireOrError( static::$Dir.'/config/NoAuth.php' );
            }
            else
            {
                static::_RequireOrError( static::$Dir.'/config/Auth.php' );
            }
        }
    }
    
}
