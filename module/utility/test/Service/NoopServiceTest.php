<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Module\Utility\Service\NoopService;

/**
 * NOOP service test
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 */
class Cradle_Module_Utility_Service_NoopServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NoopService $object
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new NoopService();
    }

    /**
     * @covers Cradle\Module\Utility\Service\NoopService::__call
     */
    public function testCall()
    {
        $this->assertFalse($this->object->_call('foo', []));
        $this->assertFalse($this->object->foo());
    }
}
