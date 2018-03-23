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
$cradle->get('/admin/system/configuration', function ($request, $response) {  
    //----------------------------//
    // 1. Security Checks
    //only for admin
    cradle('global')->requireLogin('admin');

    //----------------------------//
    // 2. Prepare Data
    
    // default type
    if (!$request->hasStage('type')) {
        $request->setStage('type', 'none');
    }

    // valid types
    $valid = ['none', 'general', 'deploy', 'rest-jwt', 'service', 'test'];

    // valid type ?
    if (!in_array($request->getStage('type'), $valid)) {
        cradle('global')->flash('Please select a valid configuration', 'error');
        return cradle('global')->redirect('/admin/system/configuration');
    }

    // get the file type
    $file = $request->getStage('type');

    // switch between config to load
    switch($file) {
        case 'general' :
            $data['item'] = cradle('global')->config('settings');
            break;
        
        case 'deploy' :
            $data['item'] = cradle('global')->config('deploy');
            break;

        case 'rest-jwt' :
            $data['item'] = cradle('global')->config('rest/jwt');
            break;

        case 'service' :
            $data['item'] = cradle('global')->config('services');
            break;
        
        case 'test' :
            $data['item'] = cradle('global')->config('test');
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
    function unpair($configuration) {
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
                    'children' => unpair($value)
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
    }

    // unpair config
    $data['item'] = unpair($data['item']);

    //----------------------------//
    // 3. Render Template
    $class = 'page-admin-system-configuration-search page-admin';
    $data['title'] = cradle('global')->translate('System Configuration');
    $body = cradle('/module/system')->template('configuration', $data, [
        'configuration_item',
        'configuration_input'
    ]);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    //render page
    cradle()->trigger('render-admin-page', $request, $response);
});

/**
 * Process the Configuration Page
 * 
 * @param Request $request
 * @param Response $response
 */
$cradle->post('/admin/system/configuration', function ($request, $response) {
    //----------------------------//
    // 1. Security Checks
    //only for admin
    cradle('global')->requireLogin('admin');

    //----------------------------//
    // 2. Prepare Data
    
    // default type
    if (!$request->hasStage('type')) {
        $request->setStage('type', 'none');
    }

    // valid types
    $valid = ['none', 'general', 'deploy', 'rest-jwt', 'service', 'test'];

    // valid type ?
    if (!in_array($request->getStage('type'), $valid)) {
        // trigger route
        return cradle()
            ->triggerRoute(
                'get',
                '/admin/system/configuration',
                $request,
                $response
            );
    }

    // get the file type
    $file = $request->getStage('type');

    // switch between config to load
    switch($file) {
        case 'general' :
            $file = cradle('global')->path('config') . '/settings.php';
            break;
        
        case 'deploy' :
            $file = cradle('global')->path('config') . '/deploy.php';
            break;

        case 'rest-jwt' :
            $file = cradle('global')->path('config') . '/rest/jwt.php';
            break;

        case 'service' :
            $file = cradle('global')->path('config') . '/services.php';
            break;
        
        case 'test' :
            $file = cradle('global')->path('config') . '/test.php';
            break;

        default :
            $file = null;
    }

    //
    // We need to bring the config back
    // to it's original structure by generating
    // key value pair.
    //
    function pair($data) {
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
                $paired[$value['key']] = pair($value['children']);

                continue;
            }

            // set key-pair
            $paired[$value['key']] = $value['value'];
        }

        return $paired;
    }

    // pair data
    $data = pair($request->getPost('item'));

    // if file is set
    if ($file) {
        // export config
        $contents = '<?php return ' . var_export($data, true) . ';';
        file_put_contents($file, $contents);
    }

    cradle('global')->flash('Configuration was updated', 'success');

    // redirect back
    return cradle('global')->redirect(
        '/admin/system/configuration?type=' . $request->getStage('type')
    );
});