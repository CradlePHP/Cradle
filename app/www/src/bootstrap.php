<?php //-->
/**
 * This file is part of a Custom Project.
*/
return function ($request, $response) {
    /**
     * 404 and 500 page
     *
     * @param Request $request
     * @param Response $response
     * @param Throwable $error
     */
    $this->error(function ($request, $response, $error) {
        //if this error has already been handled
        if ($response->hasContent()) {
            //return;
        }
        //if it was a call for an actual file
        $path = $request->getPath('string');
        if (preg_match('/\.[a-zA-Z0-9]{1,4}$/', $path)) {
            return;
        }

        if ($response->getCode() === 404) {
            $body = $this->package('/app/www')->template('404');
            $class = 'page-404 page-error';
            $title = $this->package('global')->translate('Oops...');

            //Set Content
            $response
                ->setPage('title', $title)
                ->setPage('class', $class)
                ->setContent($body);

            $this->trigger('www-render-blank', $request, $response);

            return true;
        }

        $config = $this->package('global')->config('settings');
        if ($config['environment'] === 'production' && $response->getCode() === 500) {
            $body = $this->package('/app/www')->template('500');
            $class = 'page-500 page-error';
            $title = $this->package('global')->translate('Error');

            //Set Content
            $response
                ->setPage('title', $title)
                ->setPage('class', $class)
                ->setContent($body);

            $this->trigger('www-render-blank', $request, $response);

            if (!isset($config['error_email'])
                || $config['error_email'] === '<EMAIL ADDRESS>'
            ) {
                return true;
            }

            $service = $this->package('global')->service('mail-main');

            if (!$service) {
                return true;
            }

            //prepare data
            $from = [];
            $from[$service['user']] = $service['name'];

            $to = [];
            $to[$config['error_email']] = null;

            $exception = get_class($error);
            $message = $error->getMessage();
            $line = $error->getLine();
            $file = $error->getFile();
            $trace = $error->getTraceAsString();

            $body = sprintf(
                "%s thrown: %s\n%s(%s)\n\n%s",
                $exception,
                $message,
                $file,
                $line,
                $trace
            );

            //send mail
            $message = new Swift_Message('Cradle - Error');
            $message->setFrom($from);
            $message->setTo($to);
            $message->addPart($body, 'text/plain');

            $transport = Swift_SmtpTransport::newInstance();
            $transport->setHost($service['host']);
            $transport->setPort($service['port']);
            $transport->setEncryption($service['type']);
            $transport->setUsername($service['user']);
            $transport->setPassword($service['pass']);

            $swift = Swift_Mailer::newInstance($transport);
            $swift->send($message, $failures);

            return true;
        }
    });

    /**
     * Generic template method for app/wwww
     *
     * @param *string $path
     * @param array   $data
     * @param array   $partial
     *
     * @return string
     */
    $this->package('/app/www')->addMethod('template', function (
        $file, array
        $data = [],
        $partials = []
    ) {
        // get the root directory
        $root = __DIR__ . '/template/';

        // check for partials
        if (!is_array($partials)) {
            $partials = [$partials];
        }

        $paths = [];

        foreach ($partials as $partial) {
            //Sample: product_comment => product/_comment
            //Sample: flash => _flash
            $path = str_replace('_', '/', $partial);
            $last = strrpos($path, '/');

            if ($last !== false) {
                $path = substr_replace($path, '/_', $last, 1);
            }

            $path = $path . '.html';

            if (strpos($path, '_') === false) {
                $path = '_' . $path;
            }

            $paths[$partial] = $root . $path;
        }

        $file = $root . $file . '.html';

        //render
        return cradle('global')->template($file, $data, $paths);
    });
};
