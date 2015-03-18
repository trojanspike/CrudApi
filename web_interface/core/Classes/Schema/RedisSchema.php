<?php

use Database\RedisDB;

class RedisSchema extends RedisDB {


    function down(){
        $this->flushDB();
    }

}
?>