<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Module\Utility\File;

/**
 * File tests
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 */
class Cradle_Module_Utility_FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers  Cradle\Module\Utility\File::getExtensionFromData
     */
    public function testGetExtensionFromData()
    {
        $actual = File::getExtensionFromData('data:image/jpeg;base64,xXxOoO');
        $this->assertEquals('jpg', $actual);
    }


    /**
     * @covers  Cradle\Module\Utility\File::getMimeFromData
     */
    public function testGetMimeFromData()
    {
        $actual = File::getMimeFromData('data:image/jpeg;base64,xXxOoO');
        $this->assertEquals('image/jpeg', $actual);
    }

    /**
     * @covers  Cradle\Module\Utility\File::getExtensionFromLink
     */
    public function testGetExtensionFromLink()
    {
        $actual = File::getExtensionFromLink('foo/bar.zoo.jpg');
        $this->assertEquals('jpg', $actual);
    }


    /**
     * @covers  Cradle\Module\Utility\File::getMimeFromLink
     */
    public function testGetMimeFromLink()
    {
        $actual = File::getMimeFromLink('foo/bar.zoo.jpg');
        $this->assertEquals('image/jpeg', $actual);
    }
}
