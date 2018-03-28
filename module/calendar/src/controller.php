<?php //-->
/**
 * This file is part of a Cradle Calendar Package.
 */

// Back End Controllers

/**
 * Renders a calendar
 *
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/:table/calendar', function ($request, $response) {
    //----------------------------//
    $model = $request->getStage('table');

    //set redirect
    $request->setStage('redirect_uri', '/admin/'.$model.'/search');

    // check if there's a schema
    $schema = $this->package('global')->config('schema/'.$model);

    if (!$schema) {
        // redirect
        cradle('global')->redirect('/admin/'.$model.'/search');
    }

    foreach ($schema['fields'] as $key => $field) {
        $schema['fields'][$field['name']] = $field;
        unset($schema['fields'][$key]);
    }

    $dates = ['date', 'datetime', 'created', 'updated', 'time', 'week', 'month'];

    // check if fields are date, datetime
    if ($request->getStage('show')) {
        if ($request->getStage('show')) {
            $show = $request->getStage('show');
        }

        $fields = explode(',', $show);
        foreach ($fields as $index => $column) {
            if (!isset($schema['fields'][$column]) ||
                !in_array($schema['fields'][$column]['field']['type'], $dates)) {
                cradle('global')->flash($column.' is not a date field', 'danger');
                $show = [];
                continue;
            }

            $fields[$index] = $model.'_'.$column;
        }

        $show = $fields;
    }

    if (!$show) {
        $show = [$model.'_created'];
    }

    //----------------------------//
    // 3. Render Template
    $data = [];
    $data = array_merge(
        $data,
        [
            'title' => $this->package('global')->translate($schema['singular']. ' Calendar'),
            'package' => $schema['plural'],
            'model' => $model,
            'icon'  => $schema['icon'],
            'show' => $show,
        ]);

    $class = 'page-admin-'.$model.'-calendar page-admin';
    $body = $this->package('/module/calendar')->template('calendar', $data);

    //Set Content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    //Render blank page
    $this->trigger('admin-render-page', $request, $response);
});
