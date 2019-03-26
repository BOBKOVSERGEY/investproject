<?php

namespace application\core;
class Router
{
  protected $routes = [];
  protected $params = [];

  public function __construct()
  {
    $arr = require __DIR__ . '/../config/routes.php';

    foreach ($arr as $key => $val) {
      $this->add($key, $val);
    }
  }

  // add route
  public function add($route, $params)
  {
    $route = '#^'. $route .'$#';

    $this->routes[$route] = $params;
  }

  // check route
  public function match()
  {
    // get current url
    $url =  trim($_SERVER['REQUEST_URI'], '/');

    foreach ($this->routes as $route => $params) {
      if (preg_match($route, $url, $matches)) {
        $this->params = $params;
        return true;
      }
    }

  }

  // start router
  public function run()
  {
    if ($this->match()) {
      $path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
      if (class_exists($path)) {
        $action = $this->params['action'] . 'Action';
        if (method_exists($path, $action)) {
          $controller = new $path($this->params);
          $controller->$action();
        } else {
          View::errorCode(404);
          //echo 'Action не найден ' . $action;
        }
      } else {
        View::errorCode(404);
      }
    } else {
      View::errorCode(404);
    }
  }
}