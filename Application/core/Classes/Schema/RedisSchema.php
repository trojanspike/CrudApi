<?php

use Database\RedisDB;

/**
 * Redis database setup & other tear downs etc
 * $ bin/schema down // i.e
 *
 * @copyright   28/03/15 , 16:28 lee
 * @license     MIT
 * @link        https://github.com/trojanspike/BasicAuthCRUD-api
 */

class RedisSchema extends RedisDB {


    /**
     * Flush redis DB deleting all content, used in cli $ /bin/schema down
     * 28/03/15 , 16:30
     *
     * @return void
     */
    function down()
    {
        $this->flushDB();
    }

}