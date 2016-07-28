<?php //-->
require_once __DIR__ . '/../vendor/autoload.php';

include(__DIR__.'/bootstrap.php')
	//add routes here
	
	//add flows here
	
	//add bootstrap here
	->preprocess(include(__DIR__ . '/../bootstrap/session.php'))
	->preprocess(include(__DIR__ . '/../bootstrap/handlebars.php'))
	
	//start rendering
	->render();