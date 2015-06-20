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
Api::post(function($req, $res) {
// curl http://192.168.1.18/v1/user -X POST -H 'accept:application/json' -d '{"username":"username1","email":"email1@email.com","password":"password", "extra":"extra"}'
    $User = new Users();

    if( $req->input('_csrf') && $req->input('_csrf') == Session::get('_CSRF') || Config::get('site.debug') === true )
    {
        /* Validation class would be good here */
        $_INPUT = $req->input(['username', 'email', 'password','extra']);
        if( ! $_INPUT )
        {
            $res->json(['error'=>true, 'message'=> ['all fields required'] ]);
        }

        /* Validate */
        $gump = new GUMP();
        $gump->validation_rules(array(
            'username'    => 'required|alpha_numeric|max_len,60|min_len,4',
            'email'       => 'required|valid_email',
            'password'    => 'required|max_len,60|min_len,6',
            'extra'      => 'required' /* TODO , should be json array? */
        ));
        $gump->filter_rules(array(
            'username' => 'trim|sanitize_string',
            'email'    => 'trim|sanitize_email',
            'password' => 'trim|apiUserPass'
        ));
        $validated_data = $gump->run($_INPUT);

        if($validated_data === false)
        {
            $res->json(['error'=>true, 'message'=> $gump->get_readable_errors() ]);
        }
        else
        {
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
$db = new Illuminate;

Api::get(function($req, $res) use($db) {
    // var_dump($db);
    // $result = $db->table('users')->get();
    $result = $db->table('users')->select('extra')->get();
    $res->json( $result );
});

/* update */

/* destroy */

