<?php //-->
ini_set('memory_limit', '-1');

/**
 * This file is part of the Cradle PHP Kitchen Sink Faucet Project.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Module\Utility\File;

/**
 * File Upload (supporting job)
 *
 * @param Request  $request
 * @param Response $response
 */
$cradle->on('utility-file-upload', function ($request, $response) {
    //get data
    $data = $request->getStage('data');

    //try cdn if enabled
    $s3 = $this->package('global')->service('s3-main');
    $upload = $this->package('global')->path('upload');

    //try cdn if enabled
    $data = File::base64ToS3($data, $s3);

    //try being old school
    $data = File::base64ToUpload($data, $upload);

    $response->setError(false)->setResults([
        'data' => $data
    ]);
});
