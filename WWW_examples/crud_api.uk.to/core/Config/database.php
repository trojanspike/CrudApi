<?php

return [
    
    'mysql' =>  [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'database',
            'username'  => 'root',
            'password'  => DB_PASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'options'   => array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            ),
            'prefix'    => ''
        ],
        
        
   'driver' => 'mysql',
   
   'sqlite' => realpath( __DIR__.'/../../API.sqlite' ),
   
   
   
   'redis' => [
        'host' => '127.0.0.1',
        'port' => '6379'
        ]
    
];


?>