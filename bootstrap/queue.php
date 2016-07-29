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
	
	$cradle = $this;
	
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
		->addMethod('queue', function(
			$task = null, 
			$data = array()
		) 
		use ($cradle) 
		{
			static $channel = null;
			
			//get the channel
			if(is_null($channel)) {
				$channel = $cradle
					->package('global')
					->service('queue-main')
					->channel();
			}
			
			//get the queue name
			$settings = $cradle->package('global')->config('settings');
			$name = 'queue';
			if(isset($settings['queue']) && trim($settings['queue'])) {
				$name = $settings['queue'];
			}
			
			//set the task
			$data['__TASK__'] = $task;
			
			//declare the queue
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
            $channel->basic_publish($message, $name.'-xchnge');
		});
};