<?php

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

Api::get(function($req, $res){

try {
  $uu = [];
    // Generate a version 1 (time-based) UUID object
    $uuid1 = Uuid::uuid1();
    $uu['uuid1']= $uuid1->toString() . "\n"; // e4eaaaf2-d142-11e1-b3e4-080027620cdd

    // Generate a version 3 (name-based and hashed with MD5) UUID object
    $uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
    $uu['uuid3']= $uuid3->toString() . "\n"; // 11a38b9a-b3da-360f-9353-a5a725514269


    // Generate a version 4 (random) UUID object
    $uuid4 = Uuid::uuid4();
    $uu['uuid4']= $uuid4->toString() . "\n"; // 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a


    // Generate a version 5 (name-based and hashed with SHA1) UUID object
    $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
    $uu['uuid5']= $uuid5->toString() . "\n"; // c4a760a8-dbcf-5254-a0d9-6a4474bd1b62

    $res->json([$uu]);
} catch (UnsatisfiedDependencyException $e) {

    // Some dependency was not met. Either the method cannot be called on a
    // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
    echo 'Caught exception: ' . $e->getMessage() . "\n";

}

});
