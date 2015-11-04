<?php

use App\Cache;

Api::get(function($req, $res){
    if( $params = $req->params(2) )
    {
        switch( $params[0] )
        {
            case "file":
                if( $data = Cache::file()->get($params[1]) )
                {
                    $data=json_decode($data, true);
                    $res->setContent($data['contentType'])->status(200)->outPut($data['content']);
                }
                else
                {
                    $res->json(['NA']);
                }
            break;
            case "db";
            break;
            default:
                $res->json([]);
        }
    }
    else
    {
        $res->json([]);
    }
});

/* /POST /store/file/{NAME} -X POST -d '{"contentType":"application/json", "content":"{\"key\":\"val\"}"}' */
Api::post(function($req, $res){

    if( $params = $req->params(2) )
    {
        switch( $params[0] )
        {
            case "file":
                if( $post = $req->input(['contentType', 'content']) )
                {
                    Cache::file()->put($params[1] , json_encode($post) , 120 );
                    $res->json(['OK']);
                }
                else {
                    $res->json([0]);
                }
            break;
            case "db";
                break;
            default:
                $res->json([]);
        }
    }
    else
    {
        $res->json([]);
    }
});