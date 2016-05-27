<?php

return [
    
    'mysql' =>  [
            'driver'    => 'mysql',
            'host'      => isset($_ENV['DOCKER'])?'mysql':'127.0.0.1',
            'database'  => 'CrudApi_database',
            'username'  => isset($_ENV['DOCKER'])?'api_user':'root',
            'password'  => isset($_ENV['DOCKER'])?'api_pwd':'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'options'   => array(),
            'prefix'    => ''
        ],
        
        
   'driver' => 'mysql',
   
   'sqlite' => '',
   
   'passwordSalt' => '$@kis48575Col5', /* ($is_docker && isset( $ENV['SALT'] ))?$ENV['SALT']:'$@kis48575Col5'; */
   
   'redis' => [
       	'expires' => 259200,
        'host' => isset($_ENV['DOCKER'])?'redis':'127.0.0.1',
        'port' => '6379'
        ]
    
];
