<?php


namespace application\models;


use application\core\Model;
use application\lib\Mail;

class Account extends Model
{
  public $error;

  public function validate($input, $post)
  {
    $rules = [
      'email' => [
        'pattern' => '#^([a-z0-9_.-]{1,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$#',
        'message' => 'E-mail адрес указан неверно',
      ],
      'login' => [
        'pattern' => '#^[a-z0-9]{3,15}$#',
        'message' => 'Логин указан неверно (разрешены только латинские буквы и цифры от 3 до 15 символов',
      ],
      'ref' => [
        'pattern' => '#^[a-z0-9]{3,15}$#',
        'message' => 'Логин пригласившего указан неверно',
      ],
      /*'ref' => [
        'pattern' => '#^[a-z0-9]{3,15}$#',
        'message' => 'Логин пригласившего указан неверно',
      ],*/
      'wallet' => [
        'pattern' => '#^[A-z0-9]{3,30}$#',
        'message' => 'Кошелек Perfect Money указан неверно',
      ],
      'password' => [
        'pattern' => '#^[A-z0-9]{10,30}$#',
        'message' => 'Пароль указан неверно (разрешены только латинские буквы и цифры от 10 до 30 символов',
      ],
    ];

    foreach ($input as $val) {
      if (!isset($post[$val]) or empty($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
        $this->error = $rules[$val]['message'];
        return false;
      }
    }

    if (isset($_POST['ref'])) {
      if ($post['login'] == $post['ref']) {
        $this->error = 'Регистрация невозможна';
        return false;
      }
    }

    return true;
  }

  public function checkEmailExist($email) {
    $params = [
      'email' => trim($email),
    ];
    if ($this->db->column('SELECT id FROM accounts WHERE email = :email', $params)) {
      $this->error = 'Этот email уже используется';
      return false;
    }
    return true;
  }

  public function checkEmailExistReturnId($email) {
    $params = [
      'email' => trim($email),
    ];
    return $this->db->column('SELECT id FROM accounts WHERE email = :email', $params);
  }

  public function checkLoginExist($login) {
    $params = [
      'login' => trim($login),
    ];
    if ($this->db->column('SELECT id FROM accounts WHERE login = :login', $params)) {

      return false;
    }
    return true;
  }

  public function checkRefExist($login) {
    $params = [
      'login' => trim($login),
    ];
    return $this->db->column('SELECT id FROM accounts WHERE login = :login', $params);
  }

  public function checkTokenExist($token)
  {
    $params = [
      'token' => $token,
    ];
    return $this->db->column('SELECT id FROM accounts WHERE token = :token', $params);
  }

  public function activate($token)
  {
    $params = [
      'token' => $token,
    ];
    $this->db->query('UPDATE accounts SET status = 1, token = "" WHERE token = :token', $params);
  }

  public function createToken()
  {
    return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', 30)), 0, 30);
  }

  public function register($post)
  {
    $token = $this->createToken();

    if ($post['ref'] == 'none') {
      $ref = 0;
    } else {
      $ref = $this->checkRefExist($post['ref']);
      if (!$ref) {
        $ref = 0;
      }
    }
    $params = [
      'id' => null,
      'email' => $this->security($post['email']),
      'login' => $this->security($post['login']),
      'wallet' => $this->security($post['wallet']),
      'password' => password_hash($this->security($post['password']), PASSWORD_BCRYPT),
      'ref' => $ref,
      'token' => $token,
      'status' => 0,
    ];
    $this->db->query('INSERT INTO accounts VALUES (:id, :email, :login, :wallet, :password, :ref, :token, :status)', $params);
    //debug(Mail::sendMail('Подтверждение регистрации', "<a href='http://investproject/account/confirm/{$token}'>Подтверждение регистрации http://investproject/account/confirm/{$token}</a>", $post['email']), 1);
      Mail::sendMail('Подтверждение регистрации', "<a href='http://investproject/account/confirm/{$token}'>Подтверждение регистрации http://investproject/account/confirm/{$token}</a>", $post['email']);


  }

  public function checkData($login, $password)
  {
    $params = [
      'login' => trim($login),
    ];
    $hash = $this->db->column('SELECT password FROM accounts WHERE login = :login', $params);

    if (!$hash or !password_verify($password, $hash)){
      $this->error = 'Логин или пароль указаны неверно';
      return false;
    }
    return true;
  }

  public function checkStatus($type, $data) {
    $params = [
      $type => trim($data),
    ];
    $status = $this->db->column('SELECT status FROM accounts WHERE ' . $type . ' = :' . $type, $params);


    if ($status != 1) {
      $this->error = 'Аккаунт ожидает подтверждения по email';
      return false;
    }
    return true;

  }

  public function login($login)
  {
    $params = [
      'login' => trim($login),
    ];
    $data = $this->db->row('SELECT * FROM accounts WHERE login = :login', $params);
    $_SESSION['account'] = $data[0];

  }

  public function recovery($post)
  {
    $token = $this->createToken();
    $params = [
      'email' => $this->security($post['email']),
      'token' => $token,
    ];
    $this->db->query('UPDATE accounts SET token = :token WHERE email = :email', $params);

    Mail::sendMail('Восстановление пароля', "<a href='http://investproject/account/reset/{$token}'>Восстановление пароля http://investproject/account/reset/{$token}</a>", $post['email']);

  }

  public function reset($token)
  {
    $newPassword = $this->createToken();
    $params = [
      'token' => $token,
      'password' => password_hash($newPassword, PASSWORD_BCRYPT)
    ];
    $this->db->query('UPDATE accounts SET token = "", password = :password WHERE token = :token', $params);
    return $newPassword;
  }

  public function save($post)
  {
    $sql = '';
    $params = [
      'id' => $_SESSION['account']['id'],
      'email' => $post['email'],
      'wallet' => $post['wallet'],
    ];
    if (!empty($post['password'])) {
      $params['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
      $sql .= ', password = :password';
    }

    // и запишем(обновим) данные в сессию
    foreach ($params as $key => $val) {
      $_SESSION['account'][$key] = $val;
    }
    // и запишем(обновим) данные БД
    $this->db->query('UPDATE accounts SET email = :email, wallet = :wallet' . $sql . ' WHERE id = :id', $params);
  }

}