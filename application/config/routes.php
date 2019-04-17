<?php

return [
  // MainController
  '' => [
    'controller' => 'main',
    'action' => 'index'
  ],
  // DashboardController
  'dashboard/tariffs' => [
    'controller' => 'dashboard',
    'action' => 'tariffs'
  ],
  'dashboard/invest/{id:\d+}' => [
    'controller' => 'dashboard',
    'action' => 'invest'
  ],
  'dashboard/history' => [
    'controller' => 'dashboard',
    'action' => 'history'
  ],
  'dashboard/referrals' => [
    'controller' => 'dashboard',
    'action' => 'referrals'
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
  'account/reset/{token:\w+}' => [
    'controller' => 'account',
    'action' => 'reset',
  ],
  'account/profile' => [
    'controller' => 'account',
    'action' => 'profile'
  ],
  'account/logout' => [
    'controller' => 'account',
    'action' => 'logout'
  ],
];
