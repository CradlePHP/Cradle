<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Render the Configuration Page
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/configuration', function ($request, $response) {  
    //----------------------------//
    // 1. Security Checks
    //only for admin
    $this->package('global')->requireLogin('admin');

    //----------------------------//
    // 2. Prepare Data
    
    // default type
    if (!$request->hasStage('type')) {
        $request->setStage('type', 'none');
    }

    // valid types
    $valid = ['none', 'general', 'deploy', 'service', 'test'];

    // valid type ?
    if (!in_array($request->getStage('type'), $valid)) {
        $this->package('global')->flash('Please select a valid configuration', 'error');
        return $this->package('global')->redirect('/admin/configuration');
    }

    // get the file type
    $file = $request->getStage('type');

    // switch between config to load
    switch($file) {
        case 'general' :
            $data['item'] = $this->package('global')->config('settings');
            break;
        
        case 'deploy' :
            $data['item'] = $this->package('global')->config('deploy');
            break;

        case 'service' :
            $data['item'] = $this->package('global')->config('services');
            break;
        
        case 'test' :
            $data['item'] = $this->package('global')->config('test');
            break;

        default :
            $data['item'] = [];
    }

    $data['type'] = $request->getStage('type');

    //
    // We need to unpair the configuration
    // so that we can do recursive templating
    // on the front end.
    //
    $unpair = function ($configuration) use (&$unpair) {
        // unpaired array
        $unpaired = [];

        // iterate on each configuration
        foreach($configuration as $key => $value) {
            // if config is an array
            if (is_array($value)) {
                // loop through
                $unpaired[] = [
                    'key' => $key,
                    'value' => null,
                    'children' => $unpair($value)
                ];

                continue;
            }

            // set config data
            $unpaired[] = [
                'key' => $key,
                'value' => $value,
                'children' => null
            ];
        }

        return $unpaired;
    };

    // unpair config
    $data['item'] = $unpair($data['item']);

    //----------------------------//
    // 3. Render Template
    $class = 'page-admin-configuration-search page-admin';
    $data['title'] = $this->package('global')->translate('System Configuration');
    $body = $this->package('/app/admin')->template('configuration', $data, [
        'configuration_item',
        'configuration_input'
    ]);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    //render page
    $this->trigger('admin-render-page', $request, $response);
});

/**
 * Process the Configuration Page
 * 
 * @param Request $request
 * @param Response $response
 */
$this->post('/admin/configuration', function ($request, $response) {
    //----------------------------//
    // 1. Security Checks
    //only for admin
    $this->package('global')->requireLogin('admin');

    //----------------------------//
    // 2. Prepare Data
    
    // default type
    if (!$request->hasStage('type')) {
        $request->setStage('type', 'none');
    }

    // valid types
    $valid = ['none', 'general', 'deploy', 'service', 'test'];

    // valid type ?
    if (!in_array($request->getStage('type'), $valid)) {
        // trigger route
        return $this
            ->routeTo(
                'get',
                '/admin/configuration',
                $request,
                $response
            );
    }

    // get the file type
    $file = $request->getStage('type');

    // switch between config to load
    switch($file) {
        case 'general' :
            $file = 'settings';
            break;
        
        case 'deploy' :
            $file = 'deploy';
            break;

        case 'service' :
            $file = 'services';
            break;
        
        case 'test' :
            $file = 'test';
            break;

        default :
            $file = null;
    }

    //
    // We need to bring the config back
    // to it's original structure by generating
    // key value pair.
    //
    $pair = function ($data) use (&$pair) {
        // paired data
        $paired = [];

        // iterate on each data
        foreach($data as $key => $value) {
            // skip if it doesn't have key
            if (!isset($value['key'])) {
                continue;
            }

            // if value has children
            if (isset($value['children']) 
            && is_array($value['children'])) {
                // loop through
                $paired[$value['key']] = $pair($value['children']);

                continue;
            }

            // set key-pair
            $paired[$value['key']] = $value['value'];
        }

        return $paired;
    };

    // pair data
    $data = $pair($request->getPost('item'));

    // if file is set
    if ($file) {
        // export config
        $this->package('global')->config($file, $data);
    }

    $this->package('global')->flash('Configuration was updated', 'success');

    // redirect back
    return $this->package('global')->redirect(
        '/admin/configuration?type=' . $request->getStage('type')
    );
});