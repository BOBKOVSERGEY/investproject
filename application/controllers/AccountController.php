<?php


namespace application\controllers;


use application\core\Controller;

class AccountController extends Controller
{
  public function loginAction()
  {
    $this->view->render('Вход');
  }

  public function registerAction()
  {
    //debug($this->route,1);
    if (!empty($_POST)) {
      if (!$this->model->validate(['email', 'login', 'wallet', 'password', 'ref'], $_POST)) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      } else if (!$this->model->checkEmailExist($_POST['email'])) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      } else if (!$this->model->checkLoginExist($_POST['login'])) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      }
      $this->model->register($_POST);
      $this->view->message('success', 'Подтвердите свой email', 'Регистрация завершена');
    }
    $this->view->render('Регистрация');
  }

  public function recoveryAction()
  {
    $this->view->render('Восстановление пароля');
  }

  public function confirmAction()
  {
    if (!$this->model->checkTokenExist($this->route['token'])) {
      //$this->view->errorCode(403);
      $this->view->redirect('/account/login');
    }
    $this->model->activate($this->route['token']);
    $this->view->render('Регистрация завершена');
  }
}