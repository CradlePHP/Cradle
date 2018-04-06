<?php //-->

include(__DIR__.'/../.cradle.php');

return cradle()
    //add routes here
    ->register('/app/admin')
    ->register('/app/www')

    //start rendering
    ->render();
