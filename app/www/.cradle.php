<?php //-->
/**
 * This file is part of a Custom Project.
 */
include_once __DIR__ . '/src/controller/static.php';
include_once __DIR__ . '/src/controller/article.php';
include_once __DIR__ . '/src/events.php';

//bootstrap
$this
    ->preprocess(include __DIR__ . '/src/bootstrap/errors.php')
    ->preprocess(include __DIR__ . '/src/bootstrap/template.php');
