<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2017-2019 Acme Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Http\Request;
use Cradle\Http\Response;

use Cradle\Package\System\Schema\Service;

/**
 * Admin Menu Count Job
 *
 * @param Request $request
 * @param Response $response
 */
$this->on('admin-menu-count', function ($request, $response) {
    // get navigation
    $navigation = $request->getStage('navigation');

    // check if navigation is an array
    if (!is_array($navigation)) {
        $navigation = [];
    }

    // get the schema name
    $schema = $this->package('global')->config('services', 'sql-main')['name'];

    // get table record count
    $recordCount = Service::get('sql')->getSchemaTableRecordCount($schema);

    // auth request
    $authRequest = Request::i()->load();
    // auth response
    $authResponse = Response::i()->load();

    $authRequest->setStage('auth_id', $request->getSession('me', 'auth_id'));
    $this->trigger('auth-roles', $authRequest, $authResponse);

    $roles = $authResponse->getResults();
    $roles = $roles ? array_keys($roles) : [];

    // map navigation
    $map = function($navigation, $recordCount, $roles) use (&$map) {
        // iterate on each navigation
        foreach ($navigation as $key => $value) {
            if (!empty($value['roles']) && !array_intersect($roles, $value['roles'])) {
                unset($navigation[$key]);
                continue;
            }

            // do we have child navigation?
            if (isset($value['children'])
                && is_array($value['children'])
            ) {
                // recurse through child navigations
                $navigation[$key]['children'] = $map($value['children'], $recordCount, $roles);
            }

            // iterate on each record count
            foreach ($recordCount as $count) {
                // build out the criteria
                $criteria = sprintf('/%s/search', $count['table_name']);

                // check the path based on criteria
                if (strpos($value['path'], $criteria) > 0) {
                    // set the record count
                    $navigation[$key]['records'] = $count['table_rows'];
                }
            }
        }

        return $navigation;
    };


    // map through navigation and set record count
    $navigation = $map($navigation, $recordCount, $roles);

    // set response
    return $response->setResults($navigation);
});

/**
 * Render admin page
 *
 * @param Request $request
 * @param Response $response
 */
$this->on('admin-render-page', function ($request, $response) {
    $navigation = $this->package('global')->config('admin/menu');

    $navMatch = function (...$args) use ($request) {
        //$haystack, $needle, $options
        $haystack = $request->get('path', 'string');
        $needle = array_shift($args);
        $options = array_pop($args);

        foreach ($args as $path) {
            $needle .= '/' . $path;
		}

		if (strpos($needle, '?') > 0) {
            $needle = substr($needle, 0, strpos($needle, '?'));
        }

        if (strpos($haystack, $needle) === 0) {
            return $options['fn']();
        }

        return $options['inverse']();
    };

    $this->package('global')->handlebars()->registerHelper('nav_match', $navMatch);

    // menu request
    $menuRecordRequest = Request::i()->load();
    // menu response
    $menuRecordResponse = Response::i()->load();

    // set navigation
    $menuRecordRequest->setStage('navigation', $navigation);

    // trigger menu get record count
    $this->trigger('admin-menu-count', $menuRecordRequest, $menuRecordResponse);

    // get navigation
    $navigation = $menuRecordResponse->getResults();

    $packages = $this->package('global')->config('packages');

    //path
    $path = $request->getPath('string');
    if (strpos($path, '?') !== false) {
        $path = substr($path, 0, strpos($path, '?'));
    }

    $response->addMeta('path', $path);

    $content = $this->package('/app/admin')->template(
        '_page',
        [
            'page' => $response->getPage(),
            'results' => $response->getResults(),
            'content' => $response->getContent(),
            'navigation' => $navigation,
            'i18n' => $request->getSession('i18n'),
            'packages' => array_keys($packages)
        ],
        [
            'head',
            'foot',
            'side',
            'menu'
        ]
    );

    $response->setContent($content);
});
