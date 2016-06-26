<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    [
        TASKS_DIR
    ]
);
$loader->register();
require_once __DIR__ . '/../../vendor/autoload.php';
