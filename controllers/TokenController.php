<?php

require_once(dirname(__FILE__) . '/../models/Token.php');

class TokenController {
  public static function delete() {
    if(isset($_POST['id']) && isset($_POST['user_id'])){
      Token::delete($_POST['user_id'], $_POST['id']);
    }

    header("Location: /tokens");
    exit;
  }

  public static function create() {
    if(isset($_POST['user_id'])){
      $token = Token::generateToken();
      Token::save(user()->id, $token);
    }

    header("Location: /tokens");
  }
}