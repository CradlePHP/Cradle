<?php //-->
return function($request, $response) {
	//prevent starting session in cli mode
	if(php_sapi_name() === 'cli') {
		return;
	}

	//start session
	session_start();
	
	//sync the session
	$request->setSession($_SESSION);

	//deal with flash messages
	if(isset($_SESSION['flash'])) {
		$response->set('flash', $_SESSION['flash']);
		unset($_SESSION['flash']);
	}
};