<?php //-->

use Cradle\I18n\Language;

return function ($request, $response) {
    //get the settings
    $settings = $this->package('global')->config('settings');

    //make a default translation list
    $translations = array();

    //check if there is a translation file
    $config = $this->package('global')->path('config');

    $i18n = 'en_US';

    if (isset($settings['i18n'])) {
        $i18n = $settings['i18n'];
    }

    //is there a session ?
    if ($request->hasSession('i18n')) {
        $i18n = $request->getSession('i18n');
    }

    //url paths override all possible choices
    $urlPath = $request->getDot('path.array.1');
    if (file_exists($config . '/i18n/' . $urlPath.'.php')) {
        $i18n = $urlPath;

        //if there is a session
        if (php_sapi_name() !== 'cli') {
            $_SESSION['i18n'] = $urlPath;
            $request->setSession('i18n', $urlPath);
        }

        //clean up the paths

        $pathString = $request->getPath('string');
        $pathString = substr($pathString, strlen($urlPath) + 1);

        if (!strlen($pathString)) {
            $pathString = '/';
        }

        $request->setPath($pathString);

        if ($request->hasServer('REDIRECT_URL')) {
            $url = $request->getServer('REDIRECT_URL');
            $request->set('server', 'REDIRECT_URL', $pathString);
        }

        if ($request->hasServer('REQUEST_URI')) {
            $url = $request->getServer('REQUEST_URI');
            $request->set('server', 'REQUEST_URI', $pathString);
        }
    }

    //it exists?
    if (file_exists($config . '/i18n/' . $i18n . '.php')) {
        //load the translation file
        $translations = $this->package('global')->config('i18n/' . $i18n);
    }

    //load the language class
    $language = Language::i($translations);

    //create some global methods
    $this->package('global')

    /**
     * Translate
     *
     * @param *string $string The name of the path
     * @param array   $args   The path if you want to set it
     *
     * @return string
     */
    ->addMethod('translate', function ($string, $args = []) use ($language) {
        //fix the arguments
        if (!is_array($args)) {
            $args = func_get_args();
            $string = array_shift($args);
        }

        //if we have arguments
        if (count($args)) {
            foreach ($args as $i => $arg) {
                $args[$i] = $language->get($arg);
            }

            //sprintf it
            return vsprintf($language->get($string), $args);
        }

        //just translate
        return $language->get($string);
    });
};
