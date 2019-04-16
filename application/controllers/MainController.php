<?php


namespace application\controllers;


use application\core\Controller;
use application\lib\Db;

class MainController extends Controller
{

  public function indexAction()
  {

    $vars = [
      'tariffs' => $this->tariffs
    ];
    $this->view->render('Главная', $vars);
  }

}