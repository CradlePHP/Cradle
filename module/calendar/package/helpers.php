<?php //-->

use Cradle\Storm\SqlFactory;

$this->package('/module/calendar')

/**
 * Performs an install
 *
 * @param string       $current
 * @param string|null  $type
 *
 * @return string The current version
 */
->addMethod('install', function($current = '0.0.0', $type = null) {
    $path = __DIR__ . '/install';
    //collect and organize all the versions
    $versions = [];
    $files = scandir($path);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || is_dir($path . '/' . $file)) {
            continue;
        }

        //get extension
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        //valid extensions
        if (!in_array($extension, ['php', 'sh', 'sql'])) {
            continue;
        }

        //only run updates on a following type
        if ($type && $type !== $extension) {
            continue;
        }

        //get base as version
        $version = pathinfo($file, PATHINFO_FILENAME);

        //validate version
        if (!preg_match('/^[0-9\.]+$/', $version)
            || version_compare($version, '0.0.1', '<')
        ) {
            continue;
        }

        $versions[$version][] = [
            'script' => $path . '/' . $file,
            'mode' => $extension
        ];
    }

    //sort versions
    uksort($versions, 'version_compare');

    //prepare incase
    $database = SqlFactory::load(cradle('global')->service('sql-main'));

    //now run the scripts in order of version
    foreach ($versions as $version => $files) {
        //if 0.0.0 >= 0.0.1
        if (version_compare($current, $version, '>=')) {
            continue;
        }

        //run the scripts
        foreach ($files as $file) {
            switch ($file['mode']) {
                case 'php':
                    include $file['script'];
                    break;
                case 'sql':
                    $query = file_get_contents($file['script']);
                    $database->query($query);
                    break;
                case 'sh':
                    exec($file['script']);
                    break;
            }
        }
    }

    //if 0.0.0 < 0.0.1
    if (version_compare($current, $version, '<')) {
        $current = $version;
    }

    return $current;
})

/**
 * Either returns the current available version
 * or the next version
 *
 * @param bool $next
 *
 * @return string
 */
->addMethod('version', function (bool $next = false) {
    $path = __DIR__ . '/install';

    //collect and organize all the versions
    $versions = [];
    $files = scandir($path, 0);
    foreach ($files as $file) {
        if ($file === '.'
            || $file === '..'
            || is_dir($path . '/' . $file)
        ) {
            continue;
        }

        //get extension
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if ($extension !== 'php'
            && $extension !== 'sh'
            && $extension !== 'sql'
        ) {
            continue;
        }

        //get base as version
        $version = pathinfo($file, PATHINFO_FILENAME);

        //validate version
        if (!preg_match('/^[0-9\.]+$/', $version)
            || version_compare($version, '0.0.1', '<')
        ) {
            continue;
        }

        $versions[] = $version;
    }

    if (empty($versions)) {
        return '0.0.0';
    }

    //sort versions
    usort($versions, 'version_compare');

    $version = array_pop($versions);

    if (!$next) {
        return $version;
    }

    $revisions = explode('.', $version);
    $revisions = array_reverse($revisions);

    $found = false;
    foreach ($revisions as $i => $revision) {
        if (!is_numeric($revision)) {
            continue;
        }

        $revisions[$i]++;
        $found = true;
        break;
    }

    if (!$found) {
        return $current . '.1';
    }

    $revisions = array_reverse($revisions);
    return implode('.', $revisions);
})

->addMethod('template', function (
    $file,
    array $data = [],
    $partials = []
) {
    // get the root directory
    $root =  sprintf('%s/../src/template/', __DIR__);

    // check for partials
    if (!is_array($partials)) {
        $partials = [$partials];
    }

    $paths = [];

    foreach ($partials as $partial) {
        //Sample: product_comment => product/_comment
        //Sample: flash => _flash
        $path = str_replace('_', '/', $partial);
        $last = strrpos($path, '/');

        if($last !== false) {
            $path = substr_replace($path, '/_', $last, 1);
        }

        $path = $path . '.html';

        if (strpos($path, '_') === false) {
            $path = '_' . $path;
        }

        $paths[$partial] = $root . $path;
    }

    $file = $root . $file . '.html';

    //render
    return cradle('global')->template($file, $data, $paths);
});
