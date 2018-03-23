<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility\Service;

use Predis\Client as Resource;
use Predis\Connection\ConnectionException;

/**
 * Abstract Redis Service
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
abstract class AbstractRedisService
{
    /**
     * @var Resource|null $resource
     */
    protected $resource = null;

    /**
     * @var Cradle\Sql\AbstractSql|false $sql
     */
    protected $sql = false;

    /**
     * @var Elasticsearch\ClientBuilder|false $sql
     */
    protected $elastic = false;

    /**
     * Registers the resource for use
     *
     * @param Resource $resource
     */
    abstract public function __construct(Resource $resource);

    /**
     * Cache a detail set
     *
     * @param *scalar   $id
     * @param array|int $data
     *
     * @return array
     */
    public function createDetail($id, $data)
    {
        //if an id was passed
        if (is_numeric($data)) {
            //save id
            $key = $data;

            //get it from index
            $data = $this->elastic->get($key);

            //if no index
            if (!$data) {
                //get it from database
                $data = $this->sql->get($key);
            }
        }

        try {
            return $this->resource->hSet(
                static::CACHE_DETAIL,
                $id,
                json_encode($data)
            );
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Cache a search set
     *
     * @param *array     $parameters
     * @param array|null $data
     *
     * @return array
     */
    public function createSearch(array $parameters, array $data = null)
    {
        $id = md5(json_encode($parameters));

        //if no data
        if (is_null($data)) {
            //get it from index
            $data = $this->elastic->search($parameters);

            //if no index
            if (!$data) {
                //get it from database
                $data = $this->sql->search($parameters);
            }
        }

        try {
            return $this->resource->hSet(
                static::CACHE_SEARCH,
                $id,
                json_encode($data)
            );
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Deletes everything in this key
     *
     * @return bool
     */
    public function flush()
    {
        try {
            $this->resource->del(static::CACHE_SEARCH);
            $this->resource->del(static::CACHE_DETAIL);
        } catch (ConnectionException $e) {
            return false;
        }

        return true;
    }

    /**
     * Returns a cached detail
     *
     * @param *int $id
     *
     * @return array
     */
    public function getDetail($id)
    {
        if (!$this->hasDetail($id)) {
            return false;
        }

        try {
            return json_decode(
                $this->resource->hGet(
                    static::CACHE_DETAIL,
                    $id
                ),
                true
            );
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Returns the Redis resource
     *
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Returns a cached search
     *
     * @param array $parameters
     *
     * @return array
     */
    public function getSearch(array $parameters)
    {

        if (!$this->hasSearch($parameters)) {
            return false;
        }

        $id = md5(json_encode($parameters));

        try {
            return json_decode($this->resource->hGet(static::CACHE_SEARCH, $id), true);
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Returns true if a cached detail exists
     *
     * @param *int $id
     *
     * @return array
     */
    public function hasDetail($id)
    {
        try {
            return !!$this->resource->hExists(static::CACHE_DETAIL, $id);
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Returns true if a cached search exists
     *
     * @param *array $data
     *
     * @return array
     */
    public function hasSearch(array $parameters)
    {
        $id = md5(json_encode($parameters));

        try {
            return !!$this->resource->hExists(static::CACHE_SEARCH, $id);
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Remove a cache detail
     *
     * @param int|null $id
     *
     * @return array
     */
    public function removeDetail($id = null)
    {
        if (is_null($id)) {
            try {
                return $this->resource->del(static::CACHE_DETAIL);
            } catch (ConnectionException $e) {
                return false;
            }
        }

        if (!$id) {
            return false;
        }

        try {
            return $this->resource->hDel(static::CACHE_DETAIL, $id);
        } catch (ConnectionException $e) {
            return false;
        }
    }

    /**
     * Removes a cache search
     *
     * @param array|null $data
     *
     * @return array
     */
    public function removeSearch(array $parameters = null)
    {
        if (is_null($parameters)) {
            try {
                return $this->resource->del(static::CACHE_SEARCH);
            } catch (ConnectionException $e) {
                return false;
            }
        }

        $id = md5(json_encode($parameters));

        try {
            return $this->resource->hDel(static::CACHE_SEARCH, $id);
        } catch (ConnectionException $e) {
            return false;
        }
    }
}
