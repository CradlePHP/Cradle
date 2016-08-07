<?php //-->

//embrace the wierd
return (include(__DIR__.'/../bootstrap.php'))
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
	
	//start rendering
	->render();