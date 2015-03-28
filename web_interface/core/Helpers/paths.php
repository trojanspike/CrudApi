<?php
use App\Config;

// path('www')
/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('path') )
{
    function path($path)
    {
        return Config::get('path.'.$path);
    }
}

/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('www_path') )
{
    function www_path()
    {
        return Config::get('path.www');
    }
}

/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('schema_path') )
{
    function schema_path()
    {
        return Config::get('path.schema');
    }
}

/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('storage_path') )
{
    function storage_path()
    {
        return Config::get('path.storage');
    }
}


?>