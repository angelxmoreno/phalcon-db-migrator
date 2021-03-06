<?php

use Phalcon\Di\FactoryDefault\Cli as CliDi;
use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Config as PhalconConfig;

/**
 * Read Constants
 */
include __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'constants.php';

/**
 * Read auto-loader
 */
include CONFIG_DIR . DS . 'loader.php';

/**
 * Read the configuration
 */
$config_array = include CONFIG_DIR . DS . 'config.php';
$config = new PhalconConfig($config_array);

/**
 * Read the services
 */
$di = new CliDi();
include CONFIG_DIR . DS . 'services.php';

/**
 * Create a console application
 */
$console = new ConsoleApp($di);

/**
 * Process the console arguments
 */
$arguments = [];

foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {

    /**
     * Handle
     */
    $console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config["printNewLine"]) && $config["printNewLine"]) {
        echo PHP_EOL;
    }
} catch (Exception $e) {
    echo 'App Error: ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    $err=[$e->getMessage()];
    $err += explode(PHP_EOL, $e->getTraceAsString());
    $di->getShared('logger')->error(implode('||', $err));
    exit(255);
}
