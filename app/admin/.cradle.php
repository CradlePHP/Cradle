<?php //-->
/**
 * This file is part of a Custom Project.
 */
require_once __DIR__ . '/src/events.php';
require_once __DIR__ . '/src/controller/configuration.php';
require_once __DIR__ . '/src/controller/menu.php';
require_once __DIR__ . '/src/controller/static.php';

//bootstrap
$this->preprocess(include __DIR__ . '/src/.cradle.php');
