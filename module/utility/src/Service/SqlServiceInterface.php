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
 * SQL map interface
 *
 * @vendor   Acme
 * @package  Utility
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
interface SqlServiceInterface
{
    /**
     * Create in database
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data);

    /**
     * Get detail from database
     *
     * @param *int $id
     *
     * @return array
     */
    public function get($id);

    /**
     * Remove from database
     * PLEASE BECAREFUL USING THIS !!!
     * It's here for clean up scripts
     *
     * @param *int $id
     */
    public function remove($id);

    /**
     * Search in database
     *
     * @param array $data
     *
     * @return array
     */
    public function search(array $data = []);

    /**
     * Update to database
     *
     * @param array $data
     *
     * @return array
     */
    public function update(array $data);
}
