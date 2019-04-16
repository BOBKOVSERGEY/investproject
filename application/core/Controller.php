<?php


namespace application\core;


abstract class Controller
{
  public $route;
  public $view;
  public $model;
  public $acl;
  public $tariffs;

  public function __construct($route)
  {
    $this->route = $route;
    if (!$this->checkAcl()) {
      View::errorCode(403);
    }
    $this->view = new View($route);
    $this->model = $this->loadModel($route['controller']);
    $this->tariffs = require __DIR__ . '/../config/tariffs.php' ;
  }

  public function loadModel($name)
  {
    $path = 'application\models\\' . ucfirst($name);

    if (class_exists($path)) {
      return new $path;
    }
  }

  public function checkAcl()
  {
    $path = __DIR__ . '/../acl/' . $this->route['controller'] . '.php';
    if (file_exists($path)) {
      $this->acl = require $path;
      if ($this->isAcl('all')) {
        return true;
      } else if (isset($_SESSION['account']['id']) && $this->isAcl('authorize')) {
        return true;
      } else if (!isset($_SESSION['account']['id']) && $this->isAcl('guest')) {
        return true;
      } else if (isset($_SESSION['admin']) && $this->isAcl('admin')) {
        return true;
      }
      return false;
    }
  }

  public function isAcl($key)
  {
    return in_array($this->route['action'], $this->acl[$key]);
  }
}