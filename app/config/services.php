<?php

use Phalcon\Logger\Adapter\File\Multiple as LoggerAdapter;

$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('logger', function () use ($config) {
    return new LoggerAdapter($config->logger->path);
});

