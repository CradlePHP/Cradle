<?php //-->
return function($request, $response) {
	//create a protocol like queue://job-something-awesome
	$this->protocol('queue', function($event, $request, $response) {
		//this is the task data
		$data = $request->get('post');
		
		//queue the event
		$this
			->package('global')
			->queue($event, $data)
			->save();
		
		$message = $this
			->package('global')
			->translate('%s Queued', $event);
		
		$response
			->set('body', 'error', false)
			->set('body', 'message', $message)
			->set('body', 'results', $data);
	});
	
	//create a sudo method
	$this
		->package('global')
		
		/**
		 * Queue capabilities
		 *
		 * @param string $task The task name
		 * @param array  $data Data to use for this task
		 *
		 */
		->addMethod('queue', function($task = null, $data = array()) {
			return $this
				->package('global')
				->service('rabbitmq-queue-main')
                ->setTask($task)
                ->setData($data)
				->setDurable(true);
		});
};