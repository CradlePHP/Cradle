<?php //-->

use Cradle\Handlebars\HandlebarsHandler;

return function ($request, $response) {
    $this->package('global')

    /**
     * Returns the global handlebars object
     *
     * @return Handlebars
     */
    ->addMethod('handlebars', function () {
        static $handlebars = null;

        if (is_null($handlebars)) {
            $handlebars = HandlebarsHandler::i();
        }

        return $handlebars;
    })

    /**
     * Makes a rendered  template
     *
     * @return string
     */
    ->addMethod('template', function ($file, array $data = [], array $partials = []) {
        if (!file_exists($file)) {
            return null;
        }

        $template = file_get_contents($file);
        $handlebars = cradle('global')->handlebars();

        foreach ($partials as $name => $content) {
            if (file_exists($content)) {
                $content = file_get_contents($content);
            }

            $handlebars->registerPartial($name, $content);
        }

        $compiled = $handlebars->compile($template);
        return $compiled($data);
    });

    //get handlebars
    $handlebars = $this->package('global')->handlebars();

    include_once(__DIR__ . '/helpers.php');

    //add cache folder
    //$handlebars->setCache(__DIR__.'/../compiled');
};
