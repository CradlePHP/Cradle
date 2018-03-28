<?php //-->
/**
 * This file is part of a Custom Package.
 */
require_once __DIR__ . '/package/events.php';
include_once __DIR__ . '/src/events.php';
include_once __DIR__ . '/src/controller.php';
require_once __DIR__ . '/package/helpers.php';

// NOTE: Do not use preprocessors because
// preprocessors are only called once
// command-line bootstrap.

// Since it is assumed that the preprocessors
// is already loaded when the time it gets to the
// file, the global package is already available.
