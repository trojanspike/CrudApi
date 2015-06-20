<?php
use App\Config;
/**
 * Checks if a string is JSON format
 * 20/06/15 , 17:13
 * @param  string    $value  JSON string
 * @return boolean
 */
if( ! function_exists('isJson') ) {
    function isJson($value)
    {
        return (is_string($value) && is_object(json_decode($value)) || is_array(json_decode($value))  ) ? true : false;
    }
}

/***********************************************/
/* Add Vaidators */
GUMP::add_validator("isJson", function($field, $input, $param = NULL) {
    return isJson($input[$field]);
});