<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility;

/**
 * Service interface
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
interface ServiceInterface
{
    /**
     * Returns a service
     *
     * @param *string $name
     * @param string  $key
     *
     * @return SqlService|RedisService|ElasticService|NoopService
     */
    public static function get($name, $key = 'main');
}
