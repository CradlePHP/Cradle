<?php //-->
require_once 'vendor/autoload.php';

//use the cradle function
Cradle\Framework\Decorator::DECORATE;

/**
 * This is where you would add CLI related tools
 */
return cradle()
    //add preprocesses here
    ->preprocess(function($request, $response) {
        //errors
        ini_set('display_errors', '1');

        //timezone
        date_default_timezone_set('GMT');

        //prevent starting session in cli mode
        if (php_sapi_name() !== 'cli') {
            //start session
            session_start();

            //sync the session
            $request->setSession($_SESSION);
        }
    })

    //add postprocesses here
    //add packages here
    ;
