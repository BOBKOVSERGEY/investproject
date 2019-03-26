<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($array, $die = false)
{
  echo '<pre style="font-size: 15px; color: green; ">';
  print_r($array);
  echo '</pre>';
  if ($die) die;
}
function debugVarDump($array, $exit = false)
{
  echo '<pre style="font-size: 15px; color: green; ">';
  var_dump($array);
  echo '</pre>';
  if ($exit) exit;
}