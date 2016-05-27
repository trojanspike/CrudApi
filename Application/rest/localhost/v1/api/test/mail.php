<?php
use App\Config;
use App\Cache;

Api::get(function($req, $res){
    if( $form = Cache::file()->get("mail-form") )
    {
        $res->html( Cache::file()->get('mail-form') );
    }
    else
    {
$html = <<<EFO
<form action="/v1/test-mail" method="POST">
    <p> Email : <input type="email" name="email"> </p>
    <p> Name : <input type="text" name="name"> </p>
    <p> Subject : <input type="text" name="subject"> </p>
    <p> Message : <textarea name="message"></textarea> </p>
    <p> <input type="submit" value="Send"> </p>
</form>
EFO;
        Cache::file()->put('mail-form', $html , 120);
        $res->html( $html );
    }

});

$mailer = new App\Build\Mailer;
Api::post(function( $req , $res ) use( $mailer ) {
    if( ! isset( $_POST["subject"] , $_POST["message"] , $_POST["email"] , $_POST["name"] ) )
    {
        $res->json([
            "All fields required :: test"
        ]);
    }
    $mailer->content($_POST["subject"], $_POST["message"])->to([
        "email" => $_POST["email"],
        "name"  =>  $_POST["name"]
    ]);
    $mailer->attach([
        path('storage').'/uploads/php.jpg',
        path('storage').'/uploads/attachment.zip',
        path('storage').'/uploads/Swiftmailer.pdf'
    ]);
    if( $mailer->send() )
    {
        $res->ok();
    }
    else
    {
        $res->json(["error"]);
    }
});