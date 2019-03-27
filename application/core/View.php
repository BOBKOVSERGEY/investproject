<?php


namespace application\core;


class View
{
  public $path;
  public $route;
  public $layout = 'default';

  public function __construct($route)
  {
    $this->route = $route;
    $this->path = $route['controller'] . '/' . $route['action'];
  }

  public function render($title, $vars = [])
  {
    extract($vars);
    $path = __DIR__ . '/../views/' . $this->path . '.php';
    if (file_exists($path)) {
      ob_start();
      require $path;
      $content = ob_get_clean();
      require __DIR__ . '/../views/layouts/' . $this->layout . '.php';
    } else {
      echo 'Вид не найден ' . $this->path;
    }
  }

  public static function errorCode($code)
  {
    http_response_code($code);
    $path = __DIR__ . '/../views/errors/' . $code . '.php';
    if (file_exists($path)) {
      require $path;
    }
    exit;
  }

  public function redirect($url = false)
  {
    if ($url) {
      $redirect = $url;
    } else {
      $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
  }

  public function message($status, $message, $title)
  {
    exit(json_encode(['status' => $status, 'message' => $message, 'title' => $title]));
  }

  public function location($url)
  {
    exit(json_encode(['url' => $url]));
  }

}