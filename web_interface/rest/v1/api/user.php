<?php

/*
:create,
read,
update
delete
*/


use Model\Users;
use App\Session;
use App\Config;


/* # create */
Api::post(function($req, $res, $injects){
// curl http://local.com/v1/user -X POST -H 'accept:application/json' -d '{"username":"trojan","":"","":""}'
    $User = new Users();

    if( $req->input('_csrf') && $req->input('_csrf') == Session::get('_CSRF') || Config::get('site.debug') === true ){
        /* Validation class would be good here */
        $_INPUT = $req->input(['username', 'email', 'password','extra']);
        if( ! $_INPUT ){
            $res->json(['error'=>true, 'message'=> ['all fields required'] ]);
        }

        /* Validate */
        $gump = new GUMP();
        $_INPUT = $gump->sanitize($_INPUT);
        $gump->validation_rules(array(
            'username'    => 'required|alpha_numeric|max_len,60|min_len,4',
            'email'       => 'required|valid_email',
            'password'    => 'required|max_len,60|min_len,6',
            'extra'      => 'required|alpha_dash'
        ));
        $gump->filter_rules(array(
            'username' => 'trim|sanitize_string',
            'email'    => 'trim|sanitize_email',
            'password' => 'trim|apiUserPass',
            'extra'   => 'trim'
        ));
        $validated_data = $gump->run($_INPUT);

        if($validated_data === false) {
            $res->json(['error'=>true, 'message'=> $gump->get_readable_errors() ]);
        } else {
            if($User->create($validated_data))
            {
                $res->json(['error'=>false]);
            }
            else
            {
                $res->json(['error'=>true, 'message' => ['username or email already in use.']]);
            }
        }
        /***********/
    }
    $res->json(['error' => true, 'message' => ["missingCsrf"] ]);
});

/* read */
use Database\Illuminate;

Api::get(function($req, $res){
    $db = new Illuminate;
    
    $result = $db->table('users')->select(['id','username', 'email', 'extra', 'password'])->get();
    $res->json( $result );
});

/* update */

/* destroy */

Api::error(function($message, $res){
    $res->unAuth();
});
?>
