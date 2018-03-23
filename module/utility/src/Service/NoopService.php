<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility\Service;

/**
 * Comment Noop Service
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
class NoopService
{
    /**
     * Always return false
     *
     * @param *string $name
     * @param *array  $args
     *
     * @return false
     */
    public function __call($name, array $args)
    {
        return false;
    }
}
