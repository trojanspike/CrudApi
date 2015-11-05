<?php
use App\Security\Accept;

Hooks::on("init:start", function($req, $res, $ip){
    Api::inject("Accept", new Accept($req->accept));
});
Hooks::on('login:before' , function($req, $res, $ip){
    /* Check count of failed in redis DB [IP-LOGIN-FAIL]=COUNT */
});
Hooks::on('login:success', function($req, $res, $ip){
    /* del [IP-LOGIN-FAIL] from redis */
});
Hooks::on('login:fail', function($req, $res, $ip){
    /* increment [IP-LOGIN-FAIL] */
});

hooks::on('auth:before' , function($req, $res, $ip){
    /* Check count of failed in redis DB [IP-AUTH-FAIL]=COUNT */
});
Hooks::on('auth:success', function($req, $res, $ip){
    /* del [IP-AUTH-FAIL] from redis */
});
Hooks::on('auth:fail', function($req, $res, $ip){
    /* del [IP-AUTH-FAIL] from redis */
});
Hooks::on("error:internal", function($message){
    /* Some logging */
});