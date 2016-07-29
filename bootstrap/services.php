<?php //-->
return function($request, $response) {
	//case for test injections
	$host = $request->getServer('HTTP_HOST');
	
	$services = $this
		->package('global')
		->config('services');

	//create a sudo method
	$this
		->package('global')
		
		/**
		 * Gets a service from config
		 *
		 * @param *string name
		 *
		 * @return mixed
		 */
		->addMethod('service', function($name) use (&$services) {
			if(!isset($services[$name])) {
				return null;
			}
			
			return $services[$name];
		})
		
		/**
		 * Particularly returns a SQL interface
		 *
		 * @return Cradle\Sql\SqlInterface
		 */
		->addMethod('sql', function() use (&$services) {
			return $services['sql-main'];
		})
		
		/**
		 * Particularly returns a SQL interface
		 *
		 * @return Cradle\Sql\SqlInterface
		 */
		->addMethod('queue', function() use (&$services) {
			return $services['queue-main'];
		});
};