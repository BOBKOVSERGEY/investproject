<?php


namespace application\controllers;


use application\core\Controller;

class AccountController extends Controller
{
  public function loginAction()
  {
    if (!empty($_POST)) {

      if (!$this->model->validate(['login', 'password'], $_POST)) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      } else if (!$this->model->checkData($_POST['login'], $_POST['password'])) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      } else if (!$this->model->checkStatus('login', $_POST['login'])) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      }

      $this->model->login($_POST['login']);
      $this->view->location('/account/profile');

      $this->view->message('success', 'ok', 'вход пыполнен');
    }
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
      $this->view->message('success', 'На почту отправлено письмо, подтвердите свой email', 'Регистрация завершена');
    }
    $this->view->render('Регистрация');
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

  public function profileAction()
  {
    if (!empty($_POST)) {
      if (!$this->model->validate(['email', 'wallet'], $_POST)) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      }
      $id = $this->model->checkEmailExistReturnId($_POST['email']);
      if ($id and $id != $_SESSION['account']['id']) {
        $this->view->message('error', "Этот email уже используется", 'Ошибочка');
      }
      if (!empty($_POST['password']) and !$this->model->validate(['password'], $_POST)) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      }
      $this->model->save($_POST);
      $this->view->message('success', "Ваши данный успешно обновлены", 'Отлично');
    }
    $this->view->render('Личный кабинет пользователя');
  }

  public function logoutAction()
  {
    unset($_SESSION['account']);
    $this->view->redirect('/account/login');
  }

  public function recoveryAction()
  {
    //debug($this->route,1);
    if (!empty($_POST)) {
      if (!$this->model->validate(['email'], $_POST)) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      } else if ($this->model->checkEmailExist($_POST['email'])) {
        $this->view->message('error', 'Пользователя с таким email не существует', 'Ошибочка');
      } else if (!$this->model->checkStatus('email', $_POST['email'])) {
        $this->view->message('error', $this->model->error, 'Ошибочка');
      }
      $this->model->recovery($_POST);
      $this->view->message('success', 'Запрос на восстановление пароля отправлен на Ваш email', 'Письмо отправлено');
    }
    $this->view->render('Восстановление пароля');
  }

  public function resetAction()
  {
    if (!$this->model->checkTokenExist($this->route['token'])) {
      //$this->view->errorCode(403);
      $this->view->redirect('/account/login');
    }
    $password = $this->model->reset($this->route['token']);
    $vars = [
      'password' => $password
    ];
    $this->view->render('Пароль успешно сброшен', $vars);
  }
}