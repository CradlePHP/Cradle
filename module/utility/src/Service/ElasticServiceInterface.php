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
 * ElasticSearch map interface
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
interface ElasticServiceInterface
{
    /**
     * Create in index
     *
     * @param *int $id
     *
     * @return array
     */
    public function create($id);

    /**
     * Get detail from index
     *
     * @param *int|string $id
     *
     * @return array
     */
    public function get($id);

    /**
     * Remove from index
     *
     * @param *int $id
     */
    public function remove($id);

    /**
     * Search in index
     *
     * @param array $data
     *
     * @return array
     */
    public function search(array $data = []);

    /**
     * Update to index
     *
     * @param *int $id
     *
     * @return array
     */
    public function update($id);
}
