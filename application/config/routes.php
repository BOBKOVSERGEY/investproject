<?php

return [
  // MainController
  '' => [
    'controller' => 'main',
    'action' => 'index'
  ],
  // AccountController
  'account/login' => [
    'controller' => 'account',
    'action' => 'login'
  ],
  'account/register' => [
      'controller' => 'account',
      'action' => 'register'
  ],
  'account/register/{ref:\w+}' => [
    'controller' => 'account',
    'action' => 'register'
  ],
  'account/recovery' => [
    'controller' => 'account',
    'action' => 'recovery'
  ],
  'account/confirm/{token:\w+}' => [
    'controller' => 'account',
    'action' => 'confirm',
  ],
];
