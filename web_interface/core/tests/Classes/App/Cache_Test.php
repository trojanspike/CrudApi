<?php
/**
* Short description for class
*
*
* Created by PhpStorm.
* @copyright  04/04/15 , 17:05 lee
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

class Cache_Test extends \PHPUnit_Framework_TestCase {

    private $param = false;

    public function setUp()
    {
        $this->param = true;
    }

    public function tearDown()
    {
        $this->param = false;
    }

    public function testSetupPHPUnit()
    {
        $this->assertTrue( $this->param );

    }

}

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */