<?php

spl_autoload_register(function ($class) {
    $prefix = 'Homework\\';
    $baseDir = __DIR__ . '/src/';

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $path = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $path) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
