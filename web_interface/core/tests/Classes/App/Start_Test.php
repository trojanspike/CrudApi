<?php
/**
 * Created by PhpStorm.
 * User: lee
 * Date: 29/10/15
 * Time: 11:12
 */
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
class Start_Test extends PHPUnit_Framework_TestCase {

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
        $this->assertCount(1, array('foo'));
        $this->assertTrue( $this->param );
        $this->assetTrue( false );
    }

}