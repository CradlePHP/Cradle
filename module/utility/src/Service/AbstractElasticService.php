<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Module\Utility\Service;

use Elasticsearch\Client as Resource;

use Elasticsearch\Common\Exceptions\NoNodesAvailableException;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Elasticsearch\Common\Exceptions\BadRequest400Exception;

/**
 * Abstract ElasticSearch Service
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
abstract class AbstractElasticService
{
    /**
     * @const INDEX_TYPE Index type
     */
    const INDEX_TYPE = 'main';

    /**
     * @var Resource|null $resource
     */
    protected $resource = null;

    /**
     * @var Cradle\Sql\AbstractSql|false $sql
     */
    protected $sql = false;

    /**
     * Registers the resource for use
     *
     * @param Resource $resource
     */
    abstract public function __construct(Resource $resource);

    /**
     * Create in index
     *
     * @param *int $id
     *
     * @return array
     */
    public function create($id)
    {
        $body = $this->sql->get($id);

        if (!is_array($body) || empty($body)) {
            return false;
        }

        try {
            return $this->resource->index([
                'index' => static::INDEX_NAME,
                'type' => static::INDEX_TYPE,
                'id' => $id,
                'body' => $body
            ]);
        } catch (NoNodesAvailableException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    /**
     * Get detail from index
     *
     * @param *int|string $id
     *
     * @return array
     */
    public function get($id)
    {
        try {
            $results = $this->resource->get([
                'index' => static::INDEX_NAME,
                'type' => static::INDEX_TYPE,
                'id' => $id
            ]);
        } catch (Missing404Exception $e) {
            return null;
        } catch (NoNodesAvailableException $e) {
            return false;
        }

        return $results['_source'];
    }

    /**
     * Returns the ElasticSearch resource
     *
     * @return Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Remove from index
     *
     * @param *int $id
     */
    public function remove($id)
    {
        try {
            return $this->resource->delete([
                'index' => static::INDEX_NAME,
                'type' => static::INDEX_TYPE,
                'id' => $id
            ]);
        } catch (NoNodesAvailableException $e) {
            return false;
        }
    }

    /**
     * Search in index
     *
     * @param array $data
     *
     * @return array
     */
    abstract public function search(array $data = []);

    /**
     * Update to index
     *
     * @param *int $id
     *
     * @return array
     */
    public function update($id)
    {
        $body = $this->sql->get($id);

        if (!is_array($body) || empty($body)) {
            return false;
        }

        try {
            return $this->resource->update(
                [
                    'index' => static::INDEX_NAME,
                    'type' => static::INDEX_TYPE,
                    'id' => $id,
                    'body' => [
                        'doc' => $body
                    ]
                ]
            );
        } catch (Missing404Exception $e) {
            return false;
        } catch (NoNodesAvailableException $e) {
            return false;
        }
    }
}
