<?php
use App\Config;
use App\Cache;

Api::get(function($req, $res){
    $html = <<<EFO
<form action="/v1/test-mail" method="POST">
    <p> Email : <input type="email" name="email"> </p>
    <p> Message : <textarea name="message"></textarea> </p>
    <p> <input type="submit" value="Send"> </p>
</form>
EFO;

    if( Cache::db()->get('HTML_FORM') === false )
    {
        Cache::db()->put('HTML_FORM', $html , 120);
    }

    $res->setContent('text/html')->outPut( Cache::db()->get('HTML_FORM') );

});

Api::post(function( $req , $res ){

    $mailConf = array2std( Config::get('mail')[ Config::get('mail')['default'] ] );

    $transport = Swift_SmtpTransport::newInstance($mailConf->domain, $mailConf->port , $mailConf->encrypt)
        ->setUsername($mailConf->username)
        ->setPassword($mailConf->password);

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Wonderful Subject')
        ->setTo(array($_POST['email'], $_POST['email'] => 'A name'))
        ->setBody($_POST['message']);

    $attachment = Swift_Attachment::fromPath( path('storage').'/uploads/php.jpg' , 'image/jpg');

    // Attach it to the message
    $message->attach($attachment);

    $i = 0;

    while( $i < 1 ){
        $message->setFrom(array("john@doe{$i}.com" => "John Doe {$i}"));

        $mailer->send($message);
        $i++;
    }

    $res->json([$i]);

});