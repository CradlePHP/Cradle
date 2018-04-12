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

     // pull schemas
     $navigation = $this->package('global')->config('admin/menu');

     // just in case there is no menu yet
     if (!is_array($navigation)) {
         $navigation = [];
     }

     // add default schema
     $default = [
         [
             'label' => 'Auth',
             'path' => '/admin/system/model/auth/search'
         ],
         [
             'label' => 'Profile',
             'path' => '/admin/system/model/profile/search'
         ],
         [
             'label' => 'Role',
             'path' => '/admin/system/model/role/search'
         ],
     ];

     foreach ($default as $schema) {
         $navigation[] = $schema;
     }

     $request->setStage('navigation', $navigation);
     $this->trigger('admin-menu-count', $request, $response);
     $data['schemas'] = $response->getResults();

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
