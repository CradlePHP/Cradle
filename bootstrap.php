<?php //-->
require_once 'vendor/autoload.php';

use Cradle\Frame\FrameHttp;

if(!function_exists('cradle')) {
	/**
	 * The starting point of every framework call.
	 */
	function cradle(...$args)
	{
		static $framework = null;
		
		if(is_null($framework)) {
			$framework = new FrameHttp;
		}
		
		if (func_num_args() == 0) {
			return $framework;
		}
		
		$callback = array_shift($args);
		
		if(is_callable($callback)) {
			$callback = $callback->bindTo($eden, get_class($eden));
			return call_user_func_array($callback, $args);
		}
		
		return $framework->resolve($callback, ...$args);
	}
}

return cradle()
	//add flows here
	
	//add bootstrap here
	->preprocess(include('bootstrap/paths.php'))
	->preprocess(include('bootstrap/debug.php'))
	->preprocess(include('bootstrap/errors.php'))
	->preprocess(include('bootstrap/services.php'))
	->preprocess(include('bootstrap/i18n.php'))
	->preprocess(include('bootstrap/timezone.php'))
	->preprocess(include('bootstrap/queue.php'))
	
	//add packages here
	;