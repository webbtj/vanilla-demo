<?php

require_once(dirname(__FILE__) . '/../models/AuthUser.php');

class Token {
  public static function generateToken() {
    $characters = implode('', range(0,9)) . implode('', range('a', 'z')) . implode('', range('A', 'Z'));
    $string = '';
    for ($i = 0; $i < 64; $i++) {
      $ix = rand(0, strlen($characters) - 1);
      $string .= $characters[$ix];
    }
    $string = sha1($string) . md5(time());
    return $string;
  }

  public static function save(int $user_id, String $token){
    $sql = sprintf(
      'INSERT INTO tokens (`user_id`, `token`) VALUES ("%d", "%s")',
      $user_id, $token
    );
    db()->insert($sql);
  }

  public static function delete(int $user_id, int $id){
    $sql = sprintf(
      'DELETE FROM tokens WHERE `id`=%d AND `user_id`=%d;',
      $id, $user_id
    );
    db()->delete($sql);
  }
}