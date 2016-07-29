<?php //-->
require_once __DIR__ . '/vendor/autoload.php';

use Cradle\Frame\FrameHttp;

if(!function_exists('cradle')) {
	/**
	 * The starting point of every framework call.
	 */
	function cradle(...$args)
	{
		static $framework = null;
		
		if(is_null($framework)) {
			$framework = FrameHttp::i();
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
	//now bootstrap
	->preprocess(include(__DIR__ . '/bootstrap/paths.php'))
	->preprocess(include(__DIR__ . '/bootstrap/debug.php'))
	->preprocess(include(__DIR__ . '/bootstrap/errors.php'))
	->preprocess(include(__DIR__ . '/bootstrap/services.php'))
	->preprocess(include(__DIR__ . '/bootstrap/i18n.php'))
	->preprocess(include(__DIR__ . '/bootstrap/timezone.php'))
	->preprocess(include(__DIR__ . '/bootstrap/queue.php'))
	
	->register('cradle-objects-address');