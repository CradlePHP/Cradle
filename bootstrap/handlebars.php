<?php //-->

use Cradle\Handlebars\HandlebarsHandler as Handlebars;

return function($request, $response) {
	$cradle = $this;
	
	//setup handlebars
	$cache = $this->package('global')->path('templates');
	
	$handlebars = Handlebars::i()
		//->setCache($cache)
		//simple helpers
		->registerHelper('capital', function($string, $options) {
			return ucwords($string);
		})
		->registerHelper('number', function($number, $options) {
			return number_format((float) $number, 0);
		})
		->registerHelper('price', function($price, $options) {
			return number_format((float) $price, 2);
		})
		->registerHelper('date', function($time, $format, $options) {
			return date($format, strtotime($time));
		})
		->registerHelper('strip', function($html, $options) {
			return strip_tags($html, '<p><b><em><i><strong><b><br><u><ul><li><ol>');
		})
		->registerHelper('relative', function($date, $options) {
			$settings = $this->package('global')->config('settings');
			$timezone = $this('timezone', $settings['server_timezone'], $date);
			$offset = $timezone->getOffset();
			return $timezone->toRelative(time() - $offset);
		})
		->registerHelper('minirelative', function($date, $options) {
			$settings = $this->package('global')->config('settings');
			
			$timezone = $this('timezone', $settings['server_timezone'], $date);
			$offset = $timezone->getOffset();
			$relative = $timezone->toRelative(time() - $offset);
	
			$relative = strtolower($relative);
	
			$relative = str_replace(array('from now', 'ago'), '', $relative);
			$relative = str_replace(array('seconds', 'second'), 's', $relative);
			$relative = str_replace(array('minutes', 'minute'), 'm', $relative);
			$relative = str_replace(array('hours', 'hour'), 'h', $relative);
			$relative = str_replace(array('days', 'day'), 'd', $relative);
			$relative = str_replace(array('weeks', 'week'), 'w', $relative);
			$relative = str_replace(array('months', 'month'), 'm', $relative);
			$relative = str_replace(array('years', 'year'), 'y', $relative);
			$relative = str_replace(array('yesterday', 'tomorrow'), '1d', $relative);
	
			$relative = str_replace(' ', '', $relative);
	
			if(!preg_match('/^[0-9]+[a-z]+$/', $relative)) {
				return '';
			}
	
			return $relative;
		})
		
		//intermediate helpers
		->registerHelper('settings', function($key) use ($cradle) {
			$settings = $cradle->package('global')->config('settings');
			
			if(!isset($settings[$key])) {
				return $options['inverse']();
			}
	
			if(is_object($settings[$key]) || is_array($settings[$key])) {
				return $options['fn']((array) $settings[$key]);
			}
	
			return $settings[$key];
		})
		->registerHelper('session', function($key, $options) {
			if(!isset($_SESSION[$key])) {
				return $options['inverse']();
			}
	
			if(is_object($_SESSION[$key]) || is_array($_SESSION[$key])) {
				
				return $options['fn']((array) $_SESSION[$key]);
			}
	
			return $_SESSION[$key];
		})
		->registerHelper('server', function($key, $options) {
			if(!isset($_SERVER[$key])) {
				return $options['inverse']();
			}
	
			if(is_object($_SERVER[$key]) || is_array($_SERVER[$key])) {
				return $options['fn']((array) $_SERVER[$key]);
			}
	
			return $_SERVER[$key];
		})
		->registerHelper('query', function($key, $options) {
			if(!isset($_GET[$key])) {
				return $options['inverse']();
			}
	
			if(is_object($_GET[$key]) || is_array($_GET[$key])) {
				return $options['fn']((array) $_GET[$key]);
			}
	
			return $_GET[$key];
		})
		->registerHelper('toquery', function($key = null, $value = '') {
			$query = $_GET;
			
			if(is_scalar($key) && !is_null($key) && isset($query[$key])) {
				$query[$key] = $value;
				$query = http_build_query($query);
				parse_str(urldecode($query), $query);
			}
			
			return http_build_query($query);
		})
		
		->registerHelper('environment', function($value, $options) use ($cradle) {
			$settings = $cradle->package('global')->config('settings');
	
			if(isset($settings['environment']) && $settings['environment'] === $value) {
				return $options['fn']();
			}
	
			return $options['inverse']();
		})
		
		//advanced helpers
		->registerHelper('_', function($key) use ($cradle) {
			$args = func_get_args();
			$key = array_shift($args);
			$options = array_pop($args);
	
			$more = explode(' __ ', $options['fn']());
	
			foreach($more as $arg) {
				$args[] = $arg;
			}
			
			foreach($args as $i => $arg) {
				if(is_null($arg)) {
					$args[$i] = '';
				}
			}
	
			return $cradle->package('global')->translate((string) $key, $args);
		})
		->registerHelper('key', function($key, $array, $options) {
			if(is_string($array)) {
				$array = explode(',', $array);
			}
			
			if(isset($array[$key])) {
				return $array[$key];
			}
			
			return '';
		})
		->registerHelper('in', function($value, $array, $options) {
			if(is_string($array)) {
				$array = explode(',', $array);
			}
	
			if(!is_array($array)) {
				return $options['inverse']();
			}
	
			if(in_array($value, $array)) {
				return $options['fn']();
			}
	
			return $options['inverse']();
		})
		->registerHelper('implode', function(array $list, $separator, $options) {
			foreach($list as $i => $variable) {
				if(is_string($variable)) {
					$list[$i] = "'".$variable."'";
					continue;
				}
	
				if(is_array($variable)) {
					$list[$i] = "'".implode(',', $variable)."'";
				}
			}
	
			return implode($separator, $list);
		})
		->registerHelper('explode', function($string, $separator, $options) {
			$list = explode($separator, $string);
	
			return $options['fn'](array('this' => $list));
		})
		
		->registerHelper('pager', function($total, $range, $options) {
			if($range == 0) {
				return '';
			}
	
			$show = 10;
			$start = 0;
	
			if(isset($_GET['start']) && is_numeric($_GET['start'])) {
				$start = $_GET['start'];
			}
	
			$pages     = ceil($total / $range);
			$page     = floor($start / $range) + 1;
	
			$min     = $page - $show;
			$max     = $page + $show;
	
			if($min < 1) {
				$min = 1;
			}
	
			if($max > $pages) {
				$max = $pages;
			}
	
			//if no pages
			if($pages <= 1) {
				//return nothing
				return '';
			}
	
			$buffer = array();
	
			for($i = $min; $i <= $max; $i++) {
				$_GET['start'] = ($i -1) * $range;
	
				$buffer[] = $options['fn'](array(
					'href'    => http_build_query($_GET),
					'active'  => $i == $page,
					'page'    => $i
				));
			}
	
			return implode('', $buffer);
		})
		
		->registerHelper('when', function($value1, $operator, $value2, $options) {
			$valid = false;
	
			switch (true) {
				case $operator == '=='   && $value1 == $value2:
				case $operator == '==='  && $value1 === $value2:
				case $operator == '!='   && $value1 != $value2:
				case $operator == '!=='  && $value1 !== $value2:
				case $operator == '<'    && $value1 < $value2:
				case $operator == '<='   && $value1 <= $value2:
				case $operator == '>'    && $value1 > $value2:
				case $operator == '>='   && $value1 >= $value2:
				case $operator == '&&'   && ($value1 && $value2):
				case $operator == '||'   && ($value1 || $value2):
					$valid = true;
					break;
			}
	
			if($valid) {
				return $options['fn']();
			}
	
			return $options['inverse']();
		});
	
	//create a sudo method
	$this
		->package('global')
		
		/**
		 * Returns the global handlebars object
		 *
		 * @return Handlebars
		 */
		->addMethod('handlebars', function() use ($handlebars) {
			return $handlebars;
		})
		
		/**
		 * Makes a rendered  template
		 *
		 * @return string
		 */
		->addMethod('template', function($file, array $data = array()) use ($cradle) {
			if(!file_exists($file)) {
				return null;
			}
			
			$template = file_get_contents($file);
			
			$compiled = $cradle
				->package('global')
				->handlebars()
				->compile($template);
			
			return $compiled($data);
		});
};