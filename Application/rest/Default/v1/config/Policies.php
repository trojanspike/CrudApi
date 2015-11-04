<?php

/*
'api' => [noAuth , noAuth] , if empty auth is required - by default
if false -> allow all
if array [] -> allow noAuth what ever is in array
*/
return [
    'users'             => ['POST','GET']
    ,'session'          => ['POST']
    ,'Quotes/NoAuth'    => false
    ,'Quotes/Auth'      => true
    ,'test'             => false
    ,'store'            => true
    ,'test/redis'       => false
    ,'test/Illuminate'  => false
    ,'uuid'             => false
    ,'ext/style.css'    => ['GET']
    ,'ext/script.js'    => ['GET']
    ,'ext/image.jpg'    => ['GET']
    ,'ext/image'        => ['GET']
    ,'phpinfo'          => ['GET']
    ,'test/mail'        => ['GET', 'POST']
    ,'test/config'      => ['GET']
    ,'test/accept'      => ['GET', 'POST', 'PUT', 'DELETE']
    ,'render/js'        => ['GET']
    ];
