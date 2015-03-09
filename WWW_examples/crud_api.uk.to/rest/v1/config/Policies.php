<?php

/* 
'api' => [noAuth , noAuth] , if empty auth is required - by default
if false -> allow all 
if array [] -> allow noAuth what ever is in array
*/
return [
    'user' => ['GET', 'POST'],
    'Session' => ['GET', 'POST'],
    'test' => false,
    'Quotes/NoAuth' => false,
    'Quotes/Auth' => true,
    'Data/users' => false,
    'upload' => ['GET', 'POST']
    ]
?>