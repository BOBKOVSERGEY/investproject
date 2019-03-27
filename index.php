<?php
require __DIR__ . '/application/lib/Dev.php';

use application\core\Router;

// autoload classes
spl_autoload_register(function($className) {
  $path = str_replace('\\', '/', $className . '.php');
  if (file_exists($path)) {
    require __DIR__ . '/' . $path;
    //require $path;
  }
});
// vendor
require __DIR__ . '/vendor/autoload.php';


// start session
session_start();

$router = new Router();
$router->run();


