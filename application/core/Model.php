<?php


namespace application\core;


use application\lib\Db;

abstract class Model
{
  public $db;

  public function __construct()
  {
    $this->db = new Db();
  }

  public function security($data)
  {
    return trim(strip_tags($data));
  }

}