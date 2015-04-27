<?php

/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('array2std') )
{
    function array2std( array $arr )
    {
        $stdClass = new StdClass;
        foreach( $arr as $key => $val )
        {
            if( is_array( $val ) )
            {
                $stdClass->$key = array2std($val);
            }
            else
            {
                $stdClass->$key = $val;
            }
        }
        return $stdClass;
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

if( ! function_exists('std2array') )
{
    function std2array( stdClass $stdClass )
    {
    }
}

/*
 $class = new stdClass;
 $class->name = 'Lee';
 $class->age = 32;
 
$class_vars = get_object_vars($class);
if($class instanceof stdClass){
  echo "@@";  
}
print_r($class_vars);
*/

/**
 * Does something interesting
 * 28/03/15 , 16:30
 * @param  string    $where  Where something interesting takes place
 * @param  integer  $repeat How many times something interesting should happen
 * @throws Exception If something interesting cannot happen
 * @return Status
 */

if( ! function_exists('arrayFlatten') )
{
    function arrayFlatten( array $arr )
    {
    }
}
/*
* arrayFlatten 
return iterator_to_array( 
	new RecursiveIteratorIterator(
		new RecursiveArrayIterator( $array );
	);
 , false);
*/
