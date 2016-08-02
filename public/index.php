<?php //-->

include(__DIR__.'/../bootstrap.php');

return cradle()
	//add routes here
	->get('/', 'Hello World')
	
	//add flows here
	->flow(
		'Hello World', 
		function($request, $response) {
			$message1 = '<h1>Welcome to Cradle!</h1>';
			$message2 = '<p>Now remove this process flow :)</p>';
			$response->setContent($message1 . $message2);
		}
	)
	
	//add bootstrap here
	->preprocess(include(__DIR__ . '/../bootstrap/session.php'))
	
	//add packages here
	
	//start rendering
	->render();