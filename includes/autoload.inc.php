<?php
// autoload function with namespace functionality.
spl_autoload_register('autoload');

function autoload($className) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if (strpos($url, 'scripts')) {
        $file = '../classes/' . $file . '.class.php';
    }else{
        $file = './classes/' . $file . '.class.php';
    }
    if (file_exists($file)) {
        require_once $file;
    }
}