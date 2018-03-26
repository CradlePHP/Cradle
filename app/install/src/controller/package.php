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

    // get the registered packages
    $registered = $this->getPackages();

    // load package config
    $config = $this->package('global')->config('packages');

    // list of reserved packages
    $reserved = [
        'global', 
        '/app/admin',
        '/app/install',
        '/app/www',
        '/bootstrap/packages'
    ];

    // valid packages
    $packages = [];

    // clean up and setup
    foreach($registered as $key => $package) {
        // reserved package?
        if (in_array($key, $reserved)) {
            // remove it
            unset($registered[$key]);
            continue;
        }

        // package detail
        $packages[$key] = [
            'name' => $key,
            'type' => $package->getPackageType()
        ];

        // get package version
        if (isset($config[$key]['version'])) {
            $packages[$key]['version'] = $config[$key]['version'];
        }

        // get package status
        if (isset($config[$key]['active'])) {
            $packages[$key]['active'] = true;
        }

        // if it's a vendor package
        if ($package->getPackageType() === Package::TYPE_VENDOR) {
            // try to load composer
            $composer = json_decode(
                @file_get_contents(
                    $package->getPackagePath() . '/composer.json'
                ),
                true
            );

            // merge composer data
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