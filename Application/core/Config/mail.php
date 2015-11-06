<?php
return [
    'mailgun' => [
        'domain' => 'smtp.mailgun.org'
        , 'port' => 465
        , 'encrypt' => 'ssl'
        , 'username' => 'postmaster@website.co.uk'
        , 'password' => 'password'
    ]
    ,
    'gmail' => [
        'domain' => 'smtp.gmail.com'
        , 'port' => 465
        , 'encrypt' => 'ssl'
        , 'username' => 'postmaster@website.co.uk'
        , 'password' => 'password'
    ]
    , 'aws' => [
        'domain' => 'email-smtp.eu-west-1.amazonaws.com'
        , 'port' => 465
        , 'encrypt' => 'ssl'
        , 'username' => 'postmaster@website.co.uk'
        , 'password' => 'password'
    ]
    , 'default' => 'mailgun'

    , "sender" => [
          "name" => "John Doe"
        , "email"   =>  "johndoe@website.com"
    ]
];