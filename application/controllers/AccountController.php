<?php


namespace application\controllers;


use application\core\Controller;

class AccountController extends Controller
{
  public function loginAction()
  {
    //$this->view->redirect('/account/register');


    if (!empty($_POST)){
      $this->view->location('/');
    }
    $this->view->render('Вход');
  }
  public function registerAction()
  {
    $this->view->render('Регистрация');
  }
}