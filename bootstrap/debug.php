<?php //-->
return function($request, $response) {
	//get settings from config
	$config = $this
		->package('global')
		->config('settings');

	if(!isset($config['debug_mode'])) {
		$config['debug_mode'] = 0;
	}
	
	if(!isset($config['argument_test'])) {
		$config['argument_test'] = false;
	}
	
	//if debug mode is on
	if($config['debug_mode'] && !ini_get('display_errors')) {
		ini_set('display_errors', '1');
	}
	
	//create a protocol like debug://hi
	$this->protocol('debug', function($event, $request, $response) {
		echo $event;
	});
};