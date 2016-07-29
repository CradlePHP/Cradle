<?php //-->
return function($request, $response) {
	$root = dirname(__DIR__);
	
	$paths = array(
		'root' => $root,
		'boostrap' => $root . '/bootstrap',
		'config' => $root . '/config',
		'public' => $root . '/public',
		'upload' => $root . '/public/upload',
		'template' => $root . '/template',
		'vendor' => $root . '/vendor'
	);
	
	//to make things faster, let's cache what is requested
	$cache = array();
	
	//create a sudo method
	$this
		->package('global')
		
		/**
		 * Sets or gets a path
		 *
		 * @param *string     $key         The name of the path
		 * @param string|null $destination The path if you want to set it
		 *
		 * @return Package|string|null
		 */
		->addMethod('path', function($key, $destination = null) use (&$paths) {
			if(is_string($destination)) {
				$paths[$key] = $destination;
				return $this;
			}
			
			if(isset($paths[$key])) {
				return $paths[$key];
			}
			
			return null;
		})

		/**
		 * Gets a configuration file
		 *
		 * @param *string $key The name of the configuration path
		 *
		 * @return mixed
		 */
		->addMethod('config', function($key) use (&$cache) {
			//is it already in memory?
			if(isset($cache[$key])) {
				return $cache[$key];
			}
			
			$path = $this->path('config');
			$file = $path.'/'.$key.'.php';
			
			if(!file_exists($file)) {
				return array();
			}
			
			//get the data and cache
			$cache[$key] = include($file);
	
			//return the data
			return $cache[$key];
		});
};