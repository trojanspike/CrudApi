<?php

use Model\Users;
use Model\AuthModel;
use app\Session;

/* Create */
Api::post(function($req, $res)
{
    Hooks::fire('login:before', [$req, $res, $_SERVER['REMOTE_ADDR']]);

    /* Validation */
    $_INPUT = $req->input(['username', 'password']);
    if( ! $_INPUT )
    {
        $res->json(['error'=>true, 'message'=> ['all fields required'] ]);
    }

    /* gump */
    $gump = new GUMP();
    $_INPUT = $gump->sanitize($_INPUT);
    $gump->validation_rules(array(
        'username'    => 'required|alpha_numeric|max_len,60|min_len,4',
        'password'    => 'required|max_len,60|min_len,6'
    ));
    $gump->filter_rules(array(
        'username' => 'trim|sanitize_string',
        'password' => 'trim|apiUserPass'
    ));
    $validated_data = $gump->run($_INPUT);
    if($validated_data === false)
    {
        Hooks::fire('login:fail', [$req, $res, $_SERVER['REMOTE_ADDR']]);
        $res->json(['error'=>true, 'message'=> $gump->get_readable_errors() ]);
    }
    else
    {
        $User = new Users();
        if($User->login($validated_data))
        {
            Hooks::fire('login:success', [$req, $res, $_SERVER['REMOTE_ADDR']]);
            $res->json( ['error'=>false, 'authToken' => Session::get('new_token') ] );
        }
        else
        {
            Hooks::fire('login:fail', [$req, $res, $_SERVER['REMOTE_ADDR']]);
            $res->json(['error'=>true, 'message' => ['username or email already in use.']]);
        }
    }
    /***********/
});


/* UPDATE */

/* Destroy */
Api::delete(function($req, $res){
    $AuthModel = new AuthModel;
    if( $AuthModel->destroy() )
    {
        $res->json(['error' => false]);
    }
    else
    {
        $res->json(['error'=>true]);
    }
});

