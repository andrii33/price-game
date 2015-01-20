<?php

// error_reporting(E_ALL);
error_reporting(-1);
ini_set('display_errors', 'On');
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);

 include 'includes/init.php';

 $registry->router = new Router($registry);

 // set the controller path
 $registry->router->setPath (__SITE_PATH . '/controller');

 // load up the template
 $registry->template = new Template($registry);

 // load the controller
 $registry->router->loader();

?>
