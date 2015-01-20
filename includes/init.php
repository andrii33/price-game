<?php

function __autoload($class_name) {
    $filename = $class_name . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        $file = __SITE_PATH . '/application/' . $filename;

        if (file_exists($file) == false) {
            return false;
        }
    }
    include ($file);
}

$registry = new Registry;

 // $registry->db = Db::getInstance();
