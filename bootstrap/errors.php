<?php //-->
return function($request, $response) {
	$config = $this
		->package('global')
		->config('settings');
	
	if(!isset($config['debug_mode'])) {
		$config['debug_mode'] = 0;
	}
	
	$mode = $config['debug_mode'];

	//this happens on an error
	$this
		->error(function($request, $response, $error) use ($mode) {
			$type = $response->getHeaders('Content-Type');
			
			if(!$type) {
				$type = 'text/plain';
				$response->setHeaders('Content-Type', $type);
			}
	
			switch(true) {
				case strpos($type, 'html') !== false:
					$body = $this->package('global')->errorHtml($error, !!$mode);
					break;
				case strpos($type, 'json') !== false:
					$body = $this->package('global')->errorJson($error, !!$mode);
					break;
				default:
					$body = $this->package('global')->errorText($error, !!$mode);
					break;
			}
	
			$response->setContent($body);
		})
		
		//switch to the global package
		->package('global')
		
		/**
		 * Returns a nice HTML error message
		 *
		 * @param *Throwable $error  The Throwable object
		 * @param bool       $detail whether to display error details
		 *
		 * @return string
		 */
		->addMethod('errorHtml', function(Throwable $error, $detail = false) {
			$message = 'A server Error occurred';
			
			if(!$detail) {
				return '<h1>' . $message . '</h1>';
			}
			
			$message = $error->getMessage();
			$trace = $error->getTraceAsString();

			return '<h1>' . $message . '</h1>' . nl2br($trace);
		})
		
		/**
		 * Returns a nice JSON error message
		 *
		 * @param *Throwable $error  The Throwable object
		 * @param bool       $detail whether to display error details
		 *
		 * @return string
		 */
		->addMethod('errorJson', function(Throwable $error, $detail = false) {
			$message = 'A server Error occurred';
			
			if(!$detail) {
				return json_encode(array(
					'error' => true,
					'message' => $message
				), JSON_PRETTY_PRINT);
			}
			
			$message = $error->getMessage();
			$trace = $error->getTraceAsString();
			
			return json_encode(array(
				'error'     => true,
				'message'    => $message,
				'trace'        => explode("\n", $trace)
			), JSON_PRETTY_PRINT);
		})
		
		/**
		 * Returns a nice text error message
		 *
		 * @param *Throwable $error  The Throwable object
		 * @param bool       $detail whether to display error details
		 *
		 * @return string
		 */
		->addMethod('errorText', function(Throwable $error, $detail = false) {
			$message = 'A server Error occurred';
			
			if(!$detail) {
				return $message;
			}
			
			$message = $error->getMessage();
			$trace = $error->getTraceAsString();
			
			return $message . "\n\n" . $trace;
		});
};