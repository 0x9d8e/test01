<?php

spl_autoload_register(function ($class) {

    $file = ROOT_PATH.str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }

});