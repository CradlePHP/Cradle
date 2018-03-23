<?php //-->
return function ($request, $response) {
    $settings = $this->package('global')->config('settings');

    if (!isset($settings['server_timezone'])) {
        $settings['server_timezone'] = 'GMT';
    }

    date_default_timezone_set($settings['server_timezone']);
};
