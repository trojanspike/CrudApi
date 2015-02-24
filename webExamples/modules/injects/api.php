<?php

Api::post(function($req, $res, $injects){
    $user = $injects['user'];
    $res->json([
        'username' => $user->name,
        'gender' => $user->gender,
        'job' => $user->job,
        'injects' => $injects
    ]);
});


Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});