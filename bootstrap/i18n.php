<?php //-->

use Cradle\I18n\Language;

return function($request, $response) {
	//get the settings
	$settings = $this
		->package('global')
		->config('settings');
	
	//set a default language
	if(!isset($settings['i18n'])) {
		$settings['i18n'] = 'en_US';
	}
	
	//make a default translation list
	$translations = array();

	//check if there is a translation file
	$config = $this
		->package('global')
		->path('config');
	
	$path = $config . '/i18n/' . $settings['i18n'].'.php';
	
	//it exists?
	if(file_exists($path)) {
		//load the translation file 
		$translations = $this
			->package('global')
			->config('i18n/' . $settings['i18n']);
	}
	
	//load the language class
	$language = Language::i($translations);
	
	//create some methods
	$this
		->package('global')

		/**
		 * Translate
		 *
		 * @param *string $string The name of the path
		 * @param array   $args   The path if you want to set it
		 *
		 * @return string
		 */
		->addMethod('translate', function($string, $args = array()) use ($language) {
			//fix the arguments
			if(!is_array($args)) {
                $args = func_get_args();
                $string = array_shift($args);
            }
			
			//if we have arguments
            if(count($args)) {
                foreach($args as $i => $arg) {
                    $args[$i] = $language->get($arg);
                }
				
				//sprintf it
                return vsprintf($language->get($string), $args);
            }
			
			//just translate
            return $language->get($string);
		});
	
};