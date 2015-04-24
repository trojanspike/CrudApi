<?php

hooks::on('login:before' , function($ip){
    /* Check count of failed in redis DB [IP-FAIL]=COUNT */
});
Hooks::on('login:success', function($ip){
    /* del [IP-FAIL] from redis */
});
Hooks::on('login:fail', function($ip){
    /* increment [IP-FAIL] */
});

hooks::on('auth:before' , function($ip){});
Hooks::on('auth:success', function($ip){});
Hooks::on('auth:fail', function($ip){});

