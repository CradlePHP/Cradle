<?php //-->

include(__DIR__.'/../bootstrap.php');

return cradle()
	//add routes here
	
	//add flows here
	
	//add bootstrap here
	->preprocess(include(__DIR__ . '/../bootstrap/session.php'))
	->preprocess(include(__DIR__ . '/../bootstrap/handlebars.php'))
	
	//start rendering
	->render();