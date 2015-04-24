<?php

hooks::on('login:before' , function($ip){
    /* Check count of failed in redis DB [IP-LOGIN-FAIL]=COUNT */
});
Hooks::on('login:success', function($ip){
    /* del [IP-LOGIN-FAIL] from redis */
});
Hooks::on('login:fail', function($ip){
    /* increment [IP-LOGIN-FAIL] */
});

hooks::on('auth:before' , function($ip){
    /* Check count of failed in redis DB [IP-AUTH-FAIL]=COUNT */
});
Hooks::on('auth:success', function($ip){
    /* del [IP-AUTH-FAIL] from redis */
});
Hooks::on('auth:fail', function($ip){
    /* del [IP-AUTH-FAIL] from redis */
});

