<?php //-->
return function ($request, $response) {
    //get settings from config
    $config = $this
        ->package('global')
        ->config('settings');

    if (!isset($config['debug_mode'])) {
        $config['debug_mode'] = 0;
    }

    //if debug mode is on
    if ($config['debug_mode'] && !ini_get('display_errors')) {
        ini_set('display_errors', '1');
    }
};
