<?php //-->
return function ($request, $response) {
    //prevent starting session in cli mode
    if (php_sapi_name() === 'cli') {
        return;
    }

    //start session
    session_start();

    //sync the session
    $request->setSession($_SESSION);

    $global = $this->package('global');

    //set the language
    if (!$request->hasSession('i18n')) {
        $request->setSession('i18n', 'en_US');
        $settings = $global->config('settings');
        if (isset($settings['i18n'])) {
            $request->setSession('i18n', $settings['i18n']);
        }
    }

    //deal with flash messages
    if ($request->hasSession('flash')) {
        $flash = $request->getSession('flash');
        $response->setPage('flash', $flash);
        $request->removeSession('flash');
    }

    //create some global methods
    /**
     * Short Hand Redirect
     *
     * @param *string $path
     */
    $global->addMethod('redirect', function ($path) {
        cradle()->getResponse()->addHeader('Location', $path);
    });

    /**
     * Short Hand Redirect
     *
     * @param *string $path
     */
    $global->addMethod('requireLogin', function ($type = null) use ($request) {
        // TEMPORARY UNTIL I GOT THE
        // OAUTH PROCESS WORKING
        if ($request->getStage('session') === 'false') {
            return;
        }

        if (!isset($_SESSION['me']['auth_id'])) {
            $redirect = urlencode($_SERVER['REQUEST_URI']);
            return cradle()->getDispatcher()->redirect('/auth/login?redirect_uri=' . $redirect);
        }

        if ($type && $_SESSION['me']['auth_type'] !== $type) {
            cradle('global')->flash('Unauthorized', 'danger');
            return cradle()->getDispatcher()->redirect('/');
        }
    });

    /**
     * Short Hand Redirect
     *
     * @param *string $path
     */
    $global->addMethod('flash', function ($message, $type = 'info', array $list = []) use (&$global) {
        $_SESSION['flash'] = [
            'message' => $global->translate($message),
            'type' => $type,
            'list' => $list
        ];
    });
};
