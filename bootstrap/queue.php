<?php //-->

use PhpAmqpLib\Message\AMQPMessage;

return function($request, $response) {
	//create a protocol like queue://job-something-awesome
	$this->protocol('queue', function($event, $request, $response) {
		//this is the task data
		$data = $request->get('post');
		
		//queue the event
		$this
			->package('global')
			->queue($event, $data);
		
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
		 * see: https://github.com/php-amqplib/php-amqplib
		 * which is the official PHP library from
		 * https://www.rabbitmq.com/tutorials/tutorial-one-php.html
		 *
		 * @param string $task The task name
		 * @param array  $data Data to use for this task
		 *
		 */
		->addMethod('queue', function($task = null, $data = array(), $name = 'queue') {
			static $channel = null;
			
			if(is_null($channel)) {
				$channel = $this
					->package('global')
					->service('queue-main')
					->channel();
			}
			
			$data['__TASK__'] = $this->task;
			
			$channel->queue_declare(
				$name, 
				false, 
				true, 
				false, 
				false,
				false,
				array(
					'x-max-priority' => array('I', 10)
				)
			);
			
			 // set message
        	$message = new AMQPMessage(
				json_encode($data), 
				array(
					'priority' => 'low',
					'delivery_mode' => 2
				)
			);
			
			$channel->exchange_declare($name.'-xchnge', 'direct');
            $channel->queue_bind($name, $name.'-xchnge');

            // queue it up main queue container
            $this->channel->basic_publish($message, $queue.'-xchnge');
		});
};