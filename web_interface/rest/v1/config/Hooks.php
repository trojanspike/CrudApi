<?php

Hooks::on('login:success', function($ip){});
Hooks::on('login:fail', function($ip){});

Hooks::on('auth:success', function($ip){});
Hooks::on('auth:fail', function($ip){});

