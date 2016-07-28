<?php //-->
include(__DIR__.'/bootstrap.php');

return cradle()
	//add a logger
	->addLogger(function($message) {
		echo '* ' . $message . PHP_EOL;
	})
	//register the task runner
	->preprocess(function($request, $response) {
		$cradle = $this;
		//how to process tasks
		$callback = function(
			$task, 
			$data, 
			$message
		) use (
			$cradle, 
			$request, 
			$response
		) {
			$cradle->log($task . ' is running');
			
			$request->setPost($data);
			
			$this->trigger($task, $request, $response);
			
			//if there was an error
			if($response->get('body', 'error')) {
				$error = $response->getDot('body.message');
				
				$cradle->log($error);
				$cradle->log(json_encode($data));
				
				//an exception didn't trigger
				//it just refused to do it
				//so why try it again ?
				return;
			}
			
			$cradle->log($task . ' was performed');
			$cradle->log(json_encode($data));
		};
		
		$this
			->plugin('global')
			->service('rabbitmq-dispatch-main')
			->dispatch($callback, 'queue');
	})
	//prepare will call the preprocssors
	->prepare();