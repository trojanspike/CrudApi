<?php

use App\Cache;

/*
sh:
i=0
while [ $i -lt 8500 ]
do
i=$((i+1))
curl 192.168.33.18/v1/store/file/save$i -X POST -d '{"contentType":"application/json", "content":"{\"key\":\"val\"}"}'
done

*/
/* /GET /store/file/{NAME} */
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
                if( $data = Cache::db()->get($params[1]) )
                {
                    $data=json_decode($data, true);
                    $res->setContent($data['contentType'])->status(200)->outPut($data['content']);
                }
                else
                {
                    $res->json(['NA']);
                }
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
                    Cache::file()->put($params[1] , json_encode($post) , 25 );
                    $res->json(['OK']);
                }
                else {
                    $res->json([0]);
                }
            break;
            case "db";
                if( $post = $req->input(['contentType', 'content']) )
                {
                    Cache::db()->put($params[1] , json_encode($post) , 259200 );
                    $res->json(['OK']);
                }
                else {
                    $res->json([0]);
                }
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