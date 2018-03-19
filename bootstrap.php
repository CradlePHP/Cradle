<?php //-->
require_once 'vendor/autoload.php';

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

    //add packages here
    ->register('cradlephp/cradle-queue')
    ->register('cradlephp/cradle-csrf')
    ->register('cradlephp/cradle-captcha')
    ->register('cradlephp/cradle-developer')
    ->register('cradlephp/cradle-system')

    //add modules here
    ->register('/module/utility')
    ->register('/module/profile')
    ;
