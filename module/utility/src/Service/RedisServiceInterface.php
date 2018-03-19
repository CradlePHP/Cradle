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
 * Redis map interface
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
interface RedisServiceInterface
{
    /**
     * Cache a detail set
     *
     * @param *scalar   $id
     * @param array|int $data
     *
     * @return array
     */
    public function createDetail($id, $data);

    /**
     * Cache a search set
     *
     * @param *array     $parameters
     * @param array|null $data
     *
     * @return array
     */
    public function createSearch(array $parameters, array $data = null);

    /**
     * Returns a cached detail
     *
     * @param *int $id
     *
     * @return array
     */
    public function getDetail($id);

    /**
     * Returns a cached search
     *
     * @param array $parameters
     *
     * @return array
     */
    public function getSearch(array $parameters);

    /**
     * Returns true if a cached detail exists
     *
     * @param *int $id
     *
     * @return array
     */
    public function hasDetail($id);

    /**
     * Returns true if a cached search exists
     *
     * @param *array $data
     *
     * @return array
     */
    public function hasSearch(array $parameters);

    /**
     * Remove a cache detail
     *
     * @param int|null $id
     *
     * @return array
     */
    public function removeDetail($id = null);

    /**
     * Removes a cache search
     *
     * @param array|null $data
     *
     * @return array
     */
    public function removeSearch(array $parameters = null);
}
