<?php //-->
return function($request, $response) {
	$settings = $this->package('global')->config('settings');
	date_default_timezone_set($settings['server_timezone']);
};