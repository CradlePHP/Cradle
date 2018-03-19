<?php //-->
return function ($request, $response) {
    $root = dirname(__DIR__);

    $paths = [
        'root' => $root,
        'app' => $root . '/app',
        'boostrap' => $root . '/bootstrap',
        'config' => $root . '/config',
        'module' => $root . '/module',
        'compiled' => $root . '/compiled',
        'public' => $root . '/public',
        'upload' => $root . '/public/upload',
        'template' => $root . '/template',
        'vendor' => $root . '/vendor'
    ];

    //to make things faster, let's cache what is requested
    $cache = [];

    //create some global methods
    $this->package('global')

    /**
     * Sets or gets a path
     *
     * @param *string     $key         The name of the path
     * @param string|null $destination The path if you want to set it
     *
     * @return Package|string|null
     */
    ->addMethod('path', function ($key, $destination = null) use (&$paths) {
        if (is_string($destination)) {
            $paths[$key] = $destination;
            return $this;
        }

        if (isset($paths[$key])) {
            return $paths[$key];
        }

        return null;
    })

    /**
     * Gets a configuration file
     *
     * @param *string      $path  The name of the configuration path
     * @param string|array $key   if string, will return the particular key value
     *                            if array, will set the entire config file
     * @param mixed        $value The value to set
     *
     * @return mixed
     */
    ->addMethod('config', function ($path, $key = null, $value = null) use (&$cache) {
        //is it already in memory?
        if (!isset($cache[$path])) {
            $config = $this->path('config');
            $file = $config.'/' . $path . '.php';

            if (!file_exists($file)) {
                $cache[$path] = [];
            } else {
                //get the data and cache
                $cache[$path] = include($file);
            }
        }

        if (is_null($key)) {
            //return the data
            return $cache[$path];
        }

        //if they are trying to write
        if (is_array($key) || !is_null($value)) {
            //determine file path
            $config = $this->path('config');
            $file = $config.'/' . $path . '.php';

            //if it is not a folder
            if (!is_dir(dirname($file))) {
                //make a folder
                mkdir(dirname($file), 0777, true);
            }

            //if it is not a file
            if (!file_exists($file)) {
                //make the file
                touch($file);
                chmod($file, 0777);
            }

            //if key is an array
            if (is_array($key)) {
                $cache[$path] = $key;
            } else {
                //otherwise we mean to set the value
                $cache[$path][$key] = $value;
            }

            // at any rate, update the config
            $content = "<?php //-->\nreturn ".var_export($cache[$path], true).';';
            file_put_contents($file, $content);

            //return the data
            return $cache[$path];
        }

        //they are not trying to write, they just want the key

        if (!isset($cache[$path][$key])) {
            return null;
        }

        return $cache[$path][$key];
    });
};
