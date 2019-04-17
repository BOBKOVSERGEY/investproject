<?php


namespace application\controllers;


use application\core\Controller;

class DashboardController extends Controller
{
  public function investAction()
  {
    $vars = [
      'tariff' => $this->tariffs[$this->route['id']]
    ];
    $this->view->render('Инвестировать', $vars);
  }

  public function tariffsAction()
  {
    $this->view->render('Инвестиции');
  }

  public function historyAction()
  {
    $this->view->render('История');
  }

  public function referralsAction()
  {
    $this->view->render('Рефералы');
  }

}