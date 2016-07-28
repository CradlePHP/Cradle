<?php //-->
require_once __DIR__ . '/vendor/autoload.php';

use Cradle\Frame\FrameHttp;

return FrameHttp::i()
	//add flows here
	
	//now bootstrap
	->add(include(__DIR__ . '/bootstrap/paths.php'))
	->add(include(__DIR__ . '/bootstrap/debug.php'))
	->add(include(__DIR__ . '/bootstrap/errors.php'))
	->add(include(__DIR__ . '/bootstrap/services.php'))
	->add(include(__DIR__ . '/bootstrap/i18n.php'))
	->add(include(__DIR__ . '/bootstrap/timezone.php'))
	->add(include(__DIR__ . '/bootstrap/queue.php'))
	
	//add plugins here
	
	;