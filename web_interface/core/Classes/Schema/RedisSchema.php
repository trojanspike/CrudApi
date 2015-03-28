<?php

use Database\RedisDB;

/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @copyright  28/03/15 , 16:28 lee
 * @license
 * @version
 * @link
 * @since
 */

class RedisSchema extends RedisDB {


    function down(){
        $this->flushDB();
    }

}
?>