<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */
use Cradle\Package\System\Schema\Service;

/**
 * Render Template Actions
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin', function ($request, $response) {
    return $this->routeTo('get', '/admin/dashboard', $request, $response);
});

/**
 * Render Template Actions
 *
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/dashboard', function ($request, $response) {
    //----------------------------//
    // 1. Route Permissions
    //only for admin
    $this->package('global')->requireLogin('admin');

    $data = $request->getStage();

    // pull top 5 recent activities
    $request->setStage('range', 5);
    $request->setStage('order', ['history_created' => 'DESC']);
    $this->trigger('history-search', $request, $response);
    $data['activities'] = $response->getResults('rows');

    // get schemas
    $this->trigger('system-schema-search', $request, $response);

    // schemas
    $schemas = [];

    // get the schemas
    $results = $response->getResults('rows');

    // if we have results
    if (!empty($results)) {
        foreach($results as $schema) {
            $schemas[$schema['name']] = [
                'name' => $schema['name'],
                'label' => ucwords($schema['name']),
                'path' => sprintf(
                    '/admin/system/model/%s/search',
                    $schema['name']
                ),
                'records' => 0
            ];
        }

        // get the database name
        $database = $this->package('global')->config('services', 'sql-main')['name'];

        // get the record count
        $records = Service::get('sql')->getSchemaTableRecordCount($database);

        // on each record
        foreach($records as $record) {
            if (isset($schemas[$record['table_name']])) {
                $schemas[$record['table_name']]['records'] = $record['table_rows'];
            }
        }
    }

    // set schemas to data
    $data['schemas'] = $schemas;

    //----------------------------//
    // 2. Render Template
    $class = sprintf('page-admin-dashboard page-admin');
    $data['title'] = $this->package('global')->translate('Admin Dashboard ');
    $body = cradle('/app/admin')->template('dashboard', $data);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    //render page
    $this->trigger('admin-render-page', $request, $response);
});

/**
 * Render Template Actions
 *
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/template/:action', function ($request, $response) {
    //----------------------------//
    // 1. Route Permissions
    //only for admin
    $this->package('global')->requireLogin('admin');

    $action = $request->getStage('action');

    //----------------------------//
    // 2. Render Template
    $class = sprintf('page-admin-template-%s page-admin', $action);
    $data['title'] = $this->package('global')->translate('System Template ' . ucfirst($action));
    $body = cradle('/app/admin')->template('template/' . $action, $data);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    //render page
    $this->trigger('admin-render-page', $request, $response);
});
