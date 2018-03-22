<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Render Menu Builder
 *
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/menu', function ($request, $response) {
    //----------------------------//
    // 1. Prepare Data
    $data = [ 'item' => $this->package('global')->config('admin/menu') ];

    //----------------------------//
    // 2. Render Template
    $class = 'page-admin-system-menu page-admin';
    $data['title'] = $this->package('global')->translate('Menu Builder');
    $body = $this->package('/app/admin')->template('menu', $data, [
        'menu_item',
        'menu_input'
    ]);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    $this->trigger('admin-render-page', $request, $response);
});

/**
 * Process Menu Builder
 *
 * @param Request $request
 * @param Response $response
 */
$this->post('/admin/menu', function ($request, $response) {
    //----------------------------//
    // 1. Prepare Data
    //nothing to prepare
    //----------------------------//
    // 2. Process Request
    //just add it to menu?
    // set empty item
    $item = [];

    // set item
    if ($request->getPost('item')) {
        $item = $request->getPost('item');
    }

    $this->package('global')->config('admin/menu', $item);

    //----------------------------//
    // 4. Interpret Results
    //it was good
    //add a flash
    $this->package('global')->flash('Menu was built', 'success');

    //redirect
    $this->package('global')->redirect('/admin/menu');
});
