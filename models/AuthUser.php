<?php

require_once(dirname(__FILE__) . '/../utilities/utilities.php');

class AuthUser {
  public $username;
  public $id;
  public $tokens = [];

  public function findByUsername($username) {
    $result = db()->select(sprintf('SELECT * FROM users WHERE username = "%s"', $username));
    if(is_array($result) && 1 === count($result)){
      $this->username = $result[0]['username'];
      $this->id = $result[0]['id'];
    }
    return $this->username;
  }

  public function tokens(){
    $results = db()->select(sprintf('SELECT * FROM tokens WHERE user_id = %d', $this->id));
    if(is_array($results)){
      foreach($results as $result){
        $this->tokens[] = $result;
      }
    }
    return $this->tokens;
  }
}