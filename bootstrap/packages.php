<?php //-->

return (function() {
    // load package config
    $packages = include_once(__DIR__ . '/../config/packages.php');

    // on each packages
    foreach ($packages as $package => $config) {
        // it means we should skip this package
        if (!isset($config['active'])) {
            continue;
        }

        // don't register the package
        if ($config['active'] === false) {
            continue;
        }

        // register the package
        cradle()->register($package);
    }

    return 'bootstrap/packages';
})();