<?php
use App\Config;

if( ! function_exists('api_user_pass') )
{
    function api_user_pass($pass)
    {
        return hash('crc32', Config::get('database.passwordSalt')).hash('haval192,3', $pass).'$';
    }
}



/* Add to Gump Filter
|apiUserPass
 */
GUMP::add_filter("apiUserPass", function($value) {
    return api_user_pass($value);
});

?>
