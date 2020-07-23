<?php //-->
require_once 'vendor/autoload.php';

//denote the CWD
if (!defined('CRADLE_CWD')) {
    define('CRADLE_CWD', __DIR__);
}

//use the cradle function
Cradle\Framework\Decorator::DECORATE;

/**
 * This is where you would add CLI related tools
 */
return cradle()
    //add bootstrap here
    ->preprocess(include('bootstrap/paths.php'))
    ->preprocess(include('bootstrap/debug.php'))
    ->preprocess(include('bootstrap/errors.php'))
    ->preprocess(include('bootstrap/services.php'))
    ->preprocess(include('bootstrap/timezone.php'))
    ->preprocess(include('bootstrap/session.php'))
    ->preprocess(include('bootstrap/i18n.php'))
    ->preprocess(include('bootstrap/handlebars.php'))

    //package loader
    ->register(include('bootstrap/packages.php'));
