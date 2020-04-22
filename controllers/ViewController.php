<?php

require_once(dirname(__FILE__) . '/../utilities/utilities.php');

class ViewController {
  public static function index() {
    if(loggedIn()){
      header('Location: /dashboard');
      exit;
    }
    require_once(dirname(__FILE__) . '/../views/index.php');
    return '';
  }

  public static function dashboard() {
    require_once(dirname(__FILE__) . '/../views/dashboard.php');
    return '';
  }

  public static function login() {
    require_once(dirname(__FILE__) . '/../views/login-form.php');
    return '';
  }

  public static function logout() {
    require_once(dirname(__FILE__) . '/AuthController.php');
    AuthController::logout();
    header('Location: /');
    exit;
  }

  public static function signup() {
    require_once(dirname(__FILE__) . '/../views/signup-form.php');
    return '';
  }

  public static function tokens() {
    $tokens = user()->tokens();
    require_once(dirname(__FILE__) . '/../views/tokens.php');
    return '';
  }
}