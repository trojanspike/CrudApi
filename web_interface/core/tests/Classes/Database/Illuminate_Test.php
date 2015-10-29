<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 29/10/15
 * Time: 11:17
 */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
class Illuminate_Test extends \PHPUnit_Framework_TestCase {

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