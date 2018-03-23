<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

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