<?php //-->
/**
 * This file is part of a Custom Project.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use Cradle\Framework\Package;

/**
 * Render Package Search
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/package/search', function ($request, $response) {
    //----------------------------//
    // 1. Prepare Data
    if (!$request->hasStage()) {
        $request->setStage('filter', 'active', 1);
    }

    // load package registry
    $registered = $this->package('global')->config('packages');

    // valid packages
    $packages = [];

    // active filter
    $active = (bool) $request->getStage('filter', 'active');

    // on each registered packages
    foreach ($registered as $key => $package) {
        // check filter
        if (isset($package['active'])
        && $package['active'] != $active) {
            continue;
        }

        // set package info
        $packages[$key] = $package;

        // set package name
        $packages[$key]['name'] = $key;

        // load package space
        try {
            $package = $this->package($key);
        } catch(\Exception $e) {
            $package = $this->register($key)->package($key);
        }

        // if root package
        if ($package->getPackageType() === Package::TYPE_ROOT) {
            // set package type
            $packages[$key]['type'] = 'root';

            // set package key
            $packages[$key]['key'] = substr(str_replace('/', ':', $key), 1);
        }

        // if vendor package
        if ($package->getPackageType() === Package::TYPE_VENDOR) {
            // set package type
            $packages[$key]['type'] = 'vendor';

            // set package key
            $packages[$key]['key'] = str_replace('/', ':', $key);

            // get composer data
            $composer = json_decode(
                @file_get_contents(
                    $package->getPackagePath() . '/composer.json'
                ),
                true
            );

            // merge data
            if (is_array($composer)) {
                // do not override type
                if (isset($composer['type'])) {
                    unset($composer['type']);
                }

                $packages[$key] = array_merge($packages[$key], $composer);
            }
        }

        // clone the package object
        $cloned = new ReflectionClass($package);
        // get methods
        $methods = $cloned->getProperty('methods');
        // make it accessible
        $methods->setAccessible(true);
        // get the value
        $methods = $methods->getValue($package);
        
        // if package is installable
        if (isset($methods['install'])) {
            // set installable
            $packages[$key]['installable'] = true;
        }
    }

    // set rows
    $data['rows'] = $packages;
    // set total
    $data['total'] = count($packages);

    // merge data
    $data = array_merge($data, $request->getStage());

    //----------------------------//
    // 2. Render Template
    $class = 'page-install-package-search page-install';
    $data['title'] = $this->package('global')->translate('Packages');
    $body = $this->package('/app/install')->template('package', $data);

    //set content
    $response
        ->setPage('title', $data['title'])
        ->setPage('class', $class)
        ->setContent($body);

    $this->trigger('admin-render-page', $request, $response);
});

/**
 * Process Package Enable
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/package/enable/:name', function ($request, $response) {
    //----------------------------//
    // 1. Prepare Data
    if (!$request->getStage('type')) {
        $this->package('global')->flash('Invalid Request', 'error');
        return $this->package('global')->redirect('/admin/package/search');
    }
    
    // get package name
    $name = $request->getStage('name');

    // if it's a root package
    if ($request->getStage('type') === 'root') {
        $name = '/' . str_replace(':', '/', $name);
    } else {
        $name = str_replace(':', '/', $name);
    }

    // load package config
    $config = $this->package('global')->config('packages');

    // if package is not registered
    if (!isset($config[$name])) {
        $this->package('global')->flash('Package does not exists', 'error');
        return $this->package('global')->redirect('/admin/package/search');
    }

    // set active flag
    if (isset($config[$name]['active'])) {
        $config[$name]['active'] = true;
    }

    // update package config
    $this->package('global')->config('packages', $config);

    // redirect back
    $this->package('global')->flash('Package has been enabled', 'success');
    return $this->package('global')->redirect(
        '/admin/package/search?filter[active]=0'
    );
});

/**
 * Process Package Disable
 * 
 * @param Request $request
 * @param Response $response
 */
$this->get('/admin/package/disable/:name', function ($request, $response) {
    //----------------------------//
    // 1. Prepare Data
    if (!$request->getStage('type')) {
        $this->package('global')->flash('Invalid Request', 'error');
        return $this->package('global')->redirect('/admin/package/search');
    }
    
    // get package name
    $name = $request->getStage('name');

    // if it's a root package
    if ($request->getStage('type') === 'root') {
        $name = '/' . str_replace(':', '/', $name);
    } else {
        $name = str_replace(':', '/', $name);
    }

    // load package config
    $config = $this->package('global')->config('packages');

    // if package is not registered
    if (!isset($config[$name])) {
        $this->package('global')->flash('Package does not exists', 'error');
        return $this->package('global')->redirect('/admin/package/search');
    }

    // set active flag
    if (isset($config[$name]['active'])) {
        $config[$name]['active'] = false;
    }

    // update package config
    $this->package('global')->config('packages', $config);

    // redirect back
    $this->package('global')->flash('Package has been disabled', 'success');
    return $this->package('global')->redirect('/admin/package/search');
});