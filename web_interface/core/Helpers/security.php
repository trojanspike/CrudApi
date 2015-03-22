<?php
use App\Config;

if( ! function_exists('api_user_pass') )
{
    function api_user_pass($pass)
    {
        return hash('crc32', Config::get('database.passwordSalt')).hash('haval192,3', $pass).'$';
    }
}

if( ! function_exists('AuthTokenGenerate') )
{
    function AuthTokenGenerate()
    {
        return hash('haval224,3', md5(uniqid()).time()).'.'.str_replace(' ', '#', microtime());
    }
}



/* Add to Gump Filter
|apiUserPass
 */
GUMP::add_filter("apiUserPass", function($value) {
    return api_user_pass($value);
});

?>
