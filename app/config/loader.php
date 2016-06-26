<?php

require_once VENDOR_DIR . DS . 'autoload.php';

use Phalcon\Loader;
use Dotenv\Dotenv;

$dotenv = new Dotenv(ROOT_DIR);
$dotenv->load();

$loader = new Loader();
$loader->registerDirs(
    [
        TASKS_DIR
    ]
);
$loader->register();

