<?php //-->

include(__DIR__.'/../bootstrap.php');

return cradle()
    //add routes here
    ->get('/', function ($request, $response) {
        $message = '<h1>Welcome to Cradle!</h1>';
        $response->setContent($message);
    })

    //start rendering
    ->render();
