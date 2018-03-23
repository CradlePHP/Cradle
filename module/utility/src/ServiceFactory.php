<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility;

use Cradle\Module\Utility\Service\NoopService;

/**
 * Service Factory
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
class ServiceFactory
{
    /**
     * @var array $services
     */
    protected static $services = [];

    /**
     * Returns a service
     *
     * @param *string $name
     * @param *string $class
     */
    public static function register($name, $class)
    {
        static::$services[$name] = $class;
    }

    /**
     * Returns a service
     *
     * @param *string     $name
     * @param string|null $type
     *
     * @return SqlService|RedisService|ElasticService|NoopService|array
     */
    public static function get($name, $type = null)
    {
        if (!is_null($type)) {
            if (!isset(static::$services[$name])) {
                return null;
            }

            $class = static::$services[$name];
            return $class::get($type);
        }

        //get all services matching a type

        $type = $name;
        $services = [];
        foreach (static::$services as $name => $class) {
            if ($class::get($type) instanceof NoopService) {
                continue;
            }

            $services[$name] = $class;
        }

        return $services;
    }
}
