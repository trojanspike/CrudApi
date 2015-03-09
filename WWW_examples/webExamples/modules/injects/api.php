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

// curl -u user:pass http://domain.com/auth?module=injects -X PUT -d '{"job":"Security"}' -H 'accept:application/json'
Api::put(function($req, $res, $injects){
    $user = $injects['user'];
    $user->job = $req->input('job'); // like $_POST
    /* Save to DB maybe */
    $res->json($user);
});


Api::error(function($message, $res){
    $res->status($message['status'])->json($message);
});