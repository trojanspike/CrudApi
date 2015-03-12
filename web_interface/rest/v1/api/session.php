<?php

use Model\Users;
use Model\AuthModel;
use app\Session;

/* Create */
Api::post(function($req, $res){
    $User = new Users();

    /* Validation */
    $_INPUT = $req->input(['username', 'password']);
    if( ! $_INPUT ){
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
    if($validated_data === false) {
        $res->json(['error'=>true, 'message'=> $gump->get_readable_errors() ]);
    } else {
        if($User->login($validated_data))
        {
            $res->json( ['error'=>false, 'authToken' => Session::get('new_token') ] );
        }
        else
        {
            $res->json(['error'=>true, 'message' => ['username or email already in use.']]);
        }
    }
    /***********/
});

/* read / */

Api::get(function($req, $res){

    $res->json([
        Session::get('userInfo'),
        'authToken' => Session::get('new_token')
    ]);

});

/* UPDATE */

/* Destroy */
Api::delete(function($req, $res){
    $AuthModel = new AuthModel;
    if( $AuthModel->destroy() ) {
        $res->json(['error' => false]);
    } else {
        $res->json(['error'=>true]);
    }
});



?>
