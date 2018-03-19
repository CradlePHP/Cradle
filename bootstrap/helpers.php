<?php //-->

use Cradle\Data\Registry;
use Cradle\Module\System\Utility\File;

/* String Helpers
------------------------------------------------------------------------------*/
/**
 * Capitalizes string
 *
 * @param *string
 * @param number  if 1, then only the first word
 *
 * @return string
 */
$handlebars->registerHelper('capital', function ($string, $options) {
    if ($options == 1) {
        return ucfirst($string);
    }

    return ucwords($string);
});

/**
 * Upper cases string
 *
 * @param *string
 *
 * @return string
 */
$handlebars->registerHelper('upper', function ($value) {
    return strtoupper($value);
});

/**
 * Lower cases string
 *
 * @param *string
 *
 * @return string
 */
$handlebars->registerHelper('lower', function ($value) {
    return strtolower($value);
});

/**
 * Limits the string to specified character count
 *
 * @param *string
 * @param int     The character limit
 *
 * @return string
 */
$handlebars->registerHelper('chars', function ($value, $length) {
    return strlen($value, $length);
});

/**
 * Limits the string to specified word count
 *
 * @param *string
 * @param int     The word limit
 *
 * @return string
 */
$handlebars->registerHelper('words', function ($value, $length) {
    if (str_word_count($value, 0) > $length) {
        $words = str_word_count($value, 2);
        $position = array_keys($words);
        $value = substr($value, 0, $position[$length]);
    }

    return $value;
});

/**
 * Strips HTML tags
 *
 * @param *string HTML string
 * @param string  Allowable tags
 *
 * @return string
 */
$handlebars->registerHelper('strip', function ($html, $options) {
    $allowable = '<p><b><em><i><strong><b><br><u><ul><li><ol>';
    if (is_string($options)) {
        $allowable = $options;
    }

    return strip_tags($html, $allowable);
});

/**
 * Parses Markdown
 *
 * @param *string HTML string
 * @param string  Allowable tags
 *
 * @return string
 */
$handlebars->registerHelper('markdown', function ($markdown, $options) {
    $parsedown = new Parsedown;
    return $parsedown->text($markdown);
});

/* Number Helpers
------------------------------------------------------------------------------*/
/**
 * Formats numbers with commas
 *
 * @param *number
 * @param int     Number of decimals to show
 *
 * @return string
 */
$handlebars->registerHelper('number', function ($number, $options) {
    $decimals = 0;
    if (is_numeric($options)) {
        $decimals = $options;
    }

    return number_format((float) $number, $decimals);
});

/**
 * Formats numbers to price format
 *
 * @param *number
 *
 * @return string
 */
$handlebars->registerHelper('price', function ($price, $options) {
    return number_format((float) $price, 2);
});

/**
 * Computes a math formula
 *
 * @param *string formula template
 * @param *array  formula variables
 *
 * @return string
 */
$handlebars->registerHelper('formula', function ($template, $variables = []) {
    $compiler = cradle('global')->handlebars()->getHelper('compile');
    $formula = $compiler($template, $variables);

    if (preg_match('/[a-zA-Z]/', $formula)) {
        return cradle('global')->translate('Invalid Formaula');
    }

    $expression = sprintf('return %s ;', $formula);

    try {
        return @eval($expression);
    } catch (Throwable $e) {
        return 'Parse Error';
    }
});

/**
 * Formats the given number to it's short form
 *
 * Based of: https://gist.github.com/RadGH/84edff0cc81e6326029c
 *
 * @param *string number
 * @param *int precision
 */
$handlebars->registerHelper('number_format_short', function ($number, $precision = 1) {
    if ($number < 900) {
        // 0 - 900
        $number_format = number_format($number, $precision);
        $suffix = '';
    } else if ($number < 900000) {
        // 0.9k-850k
        $number_format = number_format($number / 1000, $precision);
        $suffix = 'K';
    } else if ($number < 900000000) {
        // 0.9m-850m
        $number_format = number_format($number / 1000000, $precision);
        $suffix = 'M';
    } else if ($number < 900000000000) {
        // 0.9b-850b
        $number_format = number_format($number / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $number_format = number_format($number / 1000000000000, $precision);
        $suffix = 'T';
    }

    // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ($precision > 0) {
        $dotzero  = '.' . str_repeat('0', $precision);
        $number_format = str_replace($dotzero, '', $number_format);
    }
    return $number_format . $suffix;
});

/* Date Helpers
------------------------------------------------------------------------------*/
/**
 * Formats the string to date format
 *
 * @param *string
 * @param string  Date format
 *
 * @return string
 */
$handlebars->registerHelper('date', function ($time, $format, $options) {
    return date($format, strtotime($time));
});

/**
 *Formats the string to relative format
 *
 * @param *string
 * @param int     if 1, uses the mini relative format
 *
 * @return string
 */
$handlebars->registerHelper('relative', function ($date, $options) {
    $settings = cradle('global')->config('settings');
    $timezone = new Timezone($settings['server_timezone'], $date);
    $offset = $timezone->getOffset();
    $relative = $timezone->toRelative(time() - $offset);

    if (!is_array($options) && $options) {
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

        if (!preg_match('/^[0-9]+[a-z]+$/', $relative)) {
            return '';
        }
    }

    return $relative;
});

/* Array Helpers
------------------------------------------------------------------------------*/
/**
 * Joins an array together
 *
 * @param *array
 * @param string The connecting string
 *
 * @return string
 */
$handlebars->registerHelper('join', function (array $list, $separator, $options) {
    foreach ($list as $i => $variable) {
        if (is_string($variable)) {
            $list[$i] = "'".$variable."'";
            continue;
        }

        if (is_array($variable)) {
            $list[$i] = "'".implode(',', $variable)."'";
        }
    }

    return implode($separator, $list);
});

/**
 * Splits a string into an array
 *
 * @param *string
 * @param string  The separating string
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('split', function ($string, $separator, $options) {
    $list = explode($separator, $string);
    $list['this'] = $list;
    return $options['fn']($list);
});

/**
 * Traverses into the specified array path
 *
 * @param *array           HTML string
 * @param string[..string] array path
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('scope', function (...$args) {
    $options = array_pop($args);
    $array = array_shift($args);
    if (!is_array($array)) {
        return $options['inverse']();
    }

    $scope = Registry::i($array)->get(...$args);

    if (is_null($scope)) {
        return $options['inverse']();
    }

    if (!is_array($scope)) {
        $scope = ['this' => $scope];
        $results = $options['fn']($scope);
        if (!$results) {
            return $scope['this'];
        }

        return $results;
    }

    $scope['this'] = $scope;
    return $options['fn']($scope);
});

/* URL Helpers
------------------------------------------------------------------------------*/
/**
 * Manipulates $_GET and returns the final query
 *
 * if 1 argument, will return the key value in $_GET (should be scalar)
 * if 2 or more arguments, will set the path and return the final query
 *
 * @param *string          key in $_GET
 * @param string[..string] path in $_GET to set
 * @param string           value to set
 *
 * @return string
 */
$handlebars->registerHelper('query', function (...$args) {
    $options = array_pop($args);
    $query = cradle()->getRequest()->getGet();

    if (count($args) === 1) {
        return $query[$args];
    }

    if (count($args) > 1) {
        $registry = Registry::i($query);
        $query = $registry->set(...$args)->get();
    }

    //when making a new query, remove the start
    if (isset($query['start'])) {
        unset($query['start']);
    }

    return http_build_query($query);
});

/**
 * Manipulates sort order and returns the final query
 *
 * @param *string[..string] array path to the sorting
 *
 * @return string
 */
$handlebars->registerHelper('sorturl', function (...$args) {
    $options = array_pop($args);
    $query = cradle()->getRequest()->getGet();
    $registry = Registry::i($query);

    $value = null;
    if ($registry->exists(...$args)) {
        $value = $registry->get(...$args);
    }

    if (count($args) > 1) {
        $key = array_pop($args);
        $registry->remove(...$args);
        $args[] = $key;
    }

    if (is_null($value)) {
        $args[] = 'ASC';
        $registry->set(...$args);
    } else if ($value === 'ASC') {
        $args[] = 'DESC';
        $registry->set(...$args);
    }

    return http_build_query($registry->get());
});

/**
 * Determines the caret to be used (needs fontawesome 5)
 *
 * @param *string[..string] array path to the sorting
 *
 * @return string
 */
$handlebars->registerHelper('sortcaret', function (...$args) {
    $options = array_pop($args);
    $request = cradle()->getRequest();

    $value = null;
    if ($request->hasGet(...$args)) {
        $value = $request->getGet(...$args);
    }

    $caret = null;
    if ($value === 'ASC') {
        $caret = '<i class="fas fa-caret-up"></i>';
    } else if ($value === 'DESC') {
        $caret = '<i class="fas fa-caret-down"></i>';
    }

    return $caret;
});

/**
 * Returns the current url encoded, used for recdirect flags
 *
 * @return string
 */
$handlebars->registerHelper('redirecturl', function () {
    return urlencode(cradle()->getRequest()->getServer('REQUEST_URI'));
});

/**
 * Uses a block to generate the pagination
 *
 * @param *int total
 * @param *int range
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('pager', function ($total, $range, $options) {
    if ($range == 0) {
        return '';
    }

    $show = 10;
    $start = 0;

    if (isset($_GET['start']) && is_numeric($_GET['start'])) {
        $start = $_GET['start'];
    }

    $pages     = ceil($total / $range);
    $page     = floor($start / $range) + 1;

    $min     = $page - $show;
    $max     = $page + $show;

    if ($min < 1) {
        $min = 1;
    }

    if ($max > $pages) {
        $max = $pages;
    }

    //if no pages
    if ($pages <= 1) {
        return $options['inverse']();
    }

    $buffer = array();

    for ($i = $min; $i <= $max; $i++) {
        $_GET['start'] = ($i -1) * $range;

        $buffer[] = $options['fn'](array(
            'href'    => http_build_query($_GET),
            'active'  => $i == $page,
            'page'    => $i
        ));
    }

    return implode('', $buffer);
});

/* Conditional Helpers
------------------------------------------------------------------------------*/
/**
 * A better if statement for handlebars
 *
 * @param *scalar first value
 * @param *string compare operator
 * @param *scalar second value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('when', function (...$args) {
    //$value1, $operator, $value2, $options
    $options = array_pop($args);
    $value2 = array_pop($args);
    $operator = array_pop($args);

    $value1 = array_shift($args);

    foreach ($args as $arg) {
        if (!isset($value1[$arg])) {
            $value1 = null;
            break;
        }

        $value1 = $value1[$arg];
    }

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

    if ($valid) {
        return $options['fn']();
    }

    return $options['inverse']();
});

/**
 * The opposite of the when helper above
 *
 * @param *scalar first value
 * @param *string compare operator
 * @param *scalar second value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('otherwise', function ($value1, $operator, $value2, $options) {
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

    if ($valid) {
        return $options['inverse']();
    }

    return $options['fn']();
});

/**
 * Determines whether the array has a given key
 *
 * @param *array
 * @param mixed  value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('has', function ($array, $key, $options) {
    if (!is_array($array)) {
        return $options['inverse']();
    }

    if (isset($array[$key])) {
        return $options['fn']();
    }

    return $options['inverse']();
});

/**
 * The opposite of the has helper above
 *
 * @param *array
 * @param mixed  value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('hasnt', function ($array, $key, $options) {
    if (!is_array($array)) {
        return $options['fn']();
    }

    if (isset($array[$key])) {
        return $options['inverse']();
    }

    return $options['fn']();
});

/**
 * Determines whether the array has a given value
 *
 * @param *array
 * @param mixed  value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('in', function ($array, $value, $options) {
    if (is_string($array)) {
        $array = explode(',', $array);
    }

    if (!is_array($array)) {
        return $options['inverse']();
    }

    if (in_array($value, $array)) {
        return $options['fn']();
    }

    return $options['inverse']();
});

/**
 * The opposite of the in helper above
 *
 * @param *array
 * @param mixed  value
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('notin', function ($array, $value, $options) {
    if (is_string($array)) {
        $array = explode(',', $array);
    }

    if (!is_array($array)) {
        return $options['fn']();
    }

    if (in_array($value, $array)) {
        return $options['inverse']();
    }

    return $options['fn']();
});

/* Template Helpers
------------------------------------------------------------------------------*/
/**
 * Calls the compiler again to compile the given string (recursive)
 *
 * @param *string Handlebars template
 * @param *array  Variables to use
 *
 * @return string
 */
$handlebars->registerHelper('compile', function ($template, $variables) {
    $template = cradle('global')->handlebars()->compile($template);
    return $template($variables);
});

/**
 * Calls the compiler again to compile the given partial (recursive)
 *
 * @param *string Name of partial
 * @param *array  Variables to use
 *
 * @return string
 */
$handlebars->registerHelper('partial', function ($name, $variables) {
    $handlebars = cradle('global')->handlebars();
    $partial = $handlebars->getPartial($name);
    $template = $handlebars->compile($partial);
    return $template($variables);
});

/**
 * Force outputs any handlebars variables
 *
 * @param *mixed[..mixed] Variables to output
 */
$handlebars->registerHelper('inspect', function (...$args) {
    $options = array_pop($args);

    $template = '<h6>Argument %s:</h6><pre class="inspector">%s</pre>';

    $inspectors = [];
    foreach ($args as $i => $arg) {
        $inspectors[] = sprintf($template, $i, var_export($arg, true));
    }

    return sprintf(
        '<h5>Handlebars Inspector<h5>%s',
        implode('', $inspectors)
    );
});

/**
 * Reads the given filename and determines the file information
 *
 * @param *string file
 *
 * @return [BLOCK]
 */
$handlebars->registerHelper('fileinfo', function ($file, $options) {
    $info = [
        'name' => $file,
        'base' => basename($file),
        'path' => dirname($file),
        'extension' => File::getExtensionFromLink($file),
        'mime' => File::getMimeFromLink($file)
    ];

    $info['this'] = $info;
    return $options['fn']($info);
});

/* Framework Helpers
------------------------------------------------------------------------------*/
/**
 * Returns the settings in config/settings.php
 *
 * @param *string Key in the settings file
 *
 * @return mixed
 */
$handlebars->registerHelper('settings', function ($key, $options) {
    $settings = cradle('global')->config('settings');

    if (!isset($settings[$key])) {
        return $options['inverse']();
    }

    if (is_object($settings[$key]) || is_array($settings[$key])) {
        return $options['fn']((array) $settings[$key]);
    }

    return $settings[$key];
});

/**
 * Gives access to the current request object
 *
 * @param *string[..string] request path
 *
 * @return mixed|[BLOCK]
 */
$handlebars->registerHelper('request', function (...$args) {
    $options = array_pop($args);

    $results = cradle()->getRequest()->get(...$args);

    if (!$results) {
        return $options['inverse']();
    }

    if (is_object($results) || is_array($results)) {
        return $options['fn']((array) $results);
    }

    return $results;
});

/**
 * Gives access to the current response object
 *
 * @param *string[..string] request path
 *
 * @return mixed|[BLOCK]
 */
$handlebars->registerHelper('response', function (...$args) {
    $options = array_pop($args);

    $results = cradle()->getResponse()->get(...$args);

    if (!$results) {
        return $options['inverse']();
    }

    if (is_object($results) || is_array($results)) {
        return $options['fn']((array) $results);
    }

    return $results;
});

/**
 * Uses the config/i18n folder to determine a translation
 *
 * @param *string          string to translate
 * @param string[..string] sprintf variables
 *
 * @return string
 */
$handlebars->registerHelper('_', function ($key) {
    $args = func_get_args();
    $key = array_shift($args);
    $options = array_pop($args);

    $more = explode(' __ ', $options['fn']());

    foreach ($more as $arg) {
        $args[] = $arg;
    }

    foreach ($args as $i => $arg) {
        if (is_null($arg)) {
            $args[$i] = '';
        }
    }

    return cradle('global')->translate((string) $key, $args);
});

/**
 * Uses the config/i18n folder to determine a translation, same as above
 *
 * @param *string          string to translate
 * @param string[..string] sprintf variables
 *
 * @return string
 */
$handlebars->registerHelper('i18n', function ($key) {
    $args = func_get_args();
    $key = array_shift($args);
    $options = array_pop($args);

    $more = explode(' __ ', $options['fn']());

    foreach ($more as $arg) {
        $args[] = $arg;
    }

    foreach ($args as $i => $arg) {
        if (is_null($arg)) {
            $args[$i] = '';
        }
    }

    return cradle('global')->translate((string) $key, $args);
});

/**
 * Uses the config/i18n folder to determine a translation, same as above
 *
 * @param *string          string to translate
 * @param string[..string] sprintf variables
 *
 * @return string
 */
$handlebars->registerHelper('translate', function ($key) {
    $args = func_get_args();
    $key = array_shift($args);
    $options = array_pop($args);

    $more = explode(' __ ', $options['fn']());

    foreach ($more as $arg) {
        $args[] = $arg;
    }

    foreach ($args as $i => $arg) {
        if (is_null($arg)) {
            $args[$i] = '';
        }
    }

    return cradle('global')->translate((string) $key, $args);
});
