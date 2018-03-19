<?php //-->

include(__DIR__.'/../bootstrap.php');

return cradle()
    //add routes here
    ->register('/app/admin')
    ->register('/app/api')
    ->register('/app/www')

    //start rendering
    ->render();
