<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Module\Utility\ServiceFactory;

use Cradle\Module\Utility\Service\NoopService;

/**
 * Service factory tests
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 */
class Cradle_Module_Utility_ServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Cradle\Module\Utility\ServiceFactory::register
     * @covers Cradle\Module\Utility\ServiceFactory::get
     */
    public function testGet()
    {
        ServiceFactory::register('foobar', Cradle_Module_Utility_ServiceFactoryTest_ServiceStub::class);
        $actual = ServiceFactory::get('foobar', 'sql');
        $this->assertInstanceOf(NoopService::class, $actual);
        $actual = ServiceFactory::get('sql');
        $this->assertTrue(!empty($actual));
    }
}

class Cradle_Module_Utility_ServiceFactoryTest_ServiceStub
{
    public static function get($name)
    {
        return new NoopService();
    }
}
