<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
namespace App\Build;
use Request;
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  09/11/15 , 14:04 lee
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version
 * @link
 * @since
 */
class RequestApp extends Request {

    /**
     * Does something interesting
     * 09/11/15 , 14:05
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function params( $num="*" )
    {
        // $this-_params : arr
        $returnData = [];
        if( is_numeric($num) && count($this->_params) == $num )
        {
            for( $i = 0; $i< $num ; $i++ )
            {
                $returnData[]=$this->_params[$i];
            }
        }
        else
        {
            return false;
        }
        return $returnData;
    }

    /**
     * Does something interesting
     * 09/11/15 , 14:05
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function input( $key=false )
    {
        return $this->_returnKeyVals($this->_input, $key);
    }

    /**
     * Does something interesting
     * 09/11/15 , 14:19
     * @param  string    $where  Where something interesting takes place
     * @param  integer  $repeat How many times something interesting should happen
     * @throws Exception If something interesting cannot happen
     * @return Status
     */
    public function get($key=false)
    {
        return $this->_returnKeyVals($_GET, $key);
    }
}
