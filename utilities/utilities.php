<?php

require_once(dirname(__FILE__) . '/DB.php');
require_once(dirname(__FILE__) . '/../controllers/AuthController.php');
require_once(dirname(__FILE__) . '/../models/AuthUser.php');

function getNestedProperty($array, $index) {
  $indeces = explode('.', $index);
  $currentIndex = array_shift($indeces);
  $remainderIndeces = implode('.', $indeces);

  if (array_key_exists($currentIndex, $array)) {
    if (!empty($remainderIndeces)) {
      return getNestedProperty($array[$currentIndex], $remainderIndeces);
    } else {
      return $array[$currentIndex];
    }
  } else {
    return null;
  }
}

function dotEnv(&$config) {
  $dotEnv = file_get_contents(dirname(__FILE__) . '/../.env');
  $lines = explode("\n", $dotEnv);
  foreach ($lines as $line) {
    parse_str($line, $parsed);
    foreach($parsed as $k => $v){
      $config[$k] = $v;
    }
  }
}

function config($key = null){
  global $config;

  if (empty($config)) {
    $config = require_once(dirname(__FILE__) . '/../config.php');
  }

  if(!is_null($key)){
    if (isset($config[$key])) {
      return $config[$key];
    } else {
      return null;
    }

  } else {
    return $config;
  }
}

function db(){
  global $db;
  if(empty($db)){
    $db = new DB();
  }
  return $db;
}

function loggedIn() {
  if(session_id() == '' || !isset($_SESSION)) {
    session_start();
  }
  return AuthController::loggedIn();
}

function user(){
  global $user;
  if(empty($user)){
    if(session_id() == '' || !isset($_SESSION)) {
      session_start();
    }
    if(AuthController::loggedIn()){
      $user = new AuthUser();
      $user->findByUsername($_SESSION['username']);
    }
  }
  return $user;
}

function testToken(String $token){
  $sql = sprintf('SELECT * FROM tokens WHERE token = "%s"', $token);
  $results = db()->select($sql);
  if(count($results)){
    return true;
  } else {
    return false;
  }
}