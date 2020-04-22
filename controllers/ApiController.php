<?php

require_once(dirname(__FILE__) . '/../models/User.php');

class ApiController {
  public static function randomUser() {
    $user = new User;
    $user->fetchRandomUser();
    return json_encode($user);
  }
}