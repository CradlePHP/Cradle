<?php //-->
return function($request, $response) {
	session_start();   
	$request->set('session', $_SESSION);
	
	//deal with flash messages
	if(isset($_SESSION['flash'])) {
		$request->set('flash', $_SESSION['flash']);
		
		unset($_SESSION['flash']);
		
		$request->set('session', $_SESSION);
	}
	
	$this
		//create a protocol like session://me-to-post
		->protocol('session', function($event, $request, $response) {
			switch($event) {
				case 'me-to-post':
					if($request->isDot('session.me')) {
						$me = $request->getSession('me');
						foreach($me as $key => $value) {
							$request->setPost($key, $value);
						}
					}
					break;
				case 'results-to-me':
					if($response->isDot('body.results')) {
						$results = $response->get('body', 'results');
						
						foreach($results as $key => $value) {
							$request->setSession('me', $key, $value);
							$_SESSION['me'][$key] = $value;
						}
					}
					break;
			}
		})
		//create a protocol like redirect://somehere/path
		->protocol('redirect', function($url, $request, $response) {
			//determine the flash type
			$type = 'success';
			if($response->getDot('body.error')) {
				$type = 'error';
			}
			
			//determine the flash message
			$message = $response->get('body.message');
			
			if(strpos($url, '://') === false) {
				$url = '/' . $url;
			}
			
			if(is_string($message) && $message) {
				$_SESSION['flash'] = array(
					'message' => $message,
					'type' => $type
				);
			}
			
			header('Location: ' . $url);
			exit;
		});
};