<?php

require_once(dirname(__FILE__) . '/../utilities/utilities.php');
require_once(dirname(__FILE__) . '/../models/AuthUser.php');

class AuthController {
  public static function bearer() {
    $authUser = new AuthUser();
    $authUser->findByUsername('user1');

    $headers = apache_request_headers();
    $pass = false;
    if(isset($headers['Authorization'])){
      $parts = explode(' ', $headers['Authorization']);
      if('Bearer' === $parts[0] && count($parts) == 2){
        $pass = testToken($parts[1]);
      }
    }
    return $pass;
  }

  public static function authenticated() {
    $bearer = AuthController::bearer();
    if($bearer){
      return true;
    }
    session_start();
    $session = AuthController::loggedIn();
    return $session;
  }

  public static function login(String $username, String $password) {
    $result = db()->select(sprintf('SELECT * FROM users WHERE username = "%s"', $username));
    if(is_array($result) && 1 === count($result)){
      $hash = md5(sprintf('%s:%s', $password, config('AUTH_SALT')));
      if($hash === $result[0]['password']) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        session_write_close();
      }
    }
  }

  public static function logout() {
    session_start();
    unset($_SESSION['loggedIn']);
    session_write_close();
    session_destroy();
  }

  public static function loggedIn() {
    $authUser = new AuthUser();
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
      $authUser->findByUsername($_SESSION['username']);
      if($authUser->username) {
        return true;
      }
    }
    return false;
  }

  public static function signup(String $username, String $password, String $confirmPassword) {
    $authUser = new AuthUser();
    if(self::loggedIn()) {
      return ['error' => 'You are already signed in.'];
    }

    if($authUser->findByUsername($username)) {
      return ['error' => 'This username has already been taken.'];
    }

    if($password !== $confirmPassword) {
      return ['error' => 'The passwords do not match.'];
    }

    if(strlen($password) < 8) {
      return ['error' => 'Password must be at least 8 characters.'];
    }

    $sql = sprintf(
      'INSERT INTO users (`username`, `password`) VALUES ("%s", "%s")',
      $username, md5(sprintf('%s:%s', $password,  config('AUTH_SALT')))
    );

    if(db()->insert($sql)) {
      return ['success' => 'Your account has been created. You can now log in.'];
    } else {
      return ['error' => 'There was an error creating your account. Please try again later.'];
    }
  }

  public static function webLogin() {
    AuthController::login($_POST['username'], $_POST['password']);
    if(AuthController::loggedIn()) {
      header("Location: /dashboard");
      exit;
    } else {
      $error = "Your login credentials were invalid";
      http_response_code(200);
      require_once(dirname(__FILE__) . '/../views/login-form.php');
      return '';
    }
    return "login";
  }

  public static function webSignup() {
    $results = [];
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
      $results = AuthController::signup($_POST['username'], $_POST['password'], $_POST['confirm_password']);
    }
    if(isset($results['error'])){
      $error = $results['error'];
      http_response_code(200);
      require_once(dirname(__FILE__) . '/../views/signup-form.php');
      return '';
    }elseif(isset($results['success'])){
        $success = $results['success'];
        http_response_code(200);
        require_once(dirname(__FILE__) . '/../views/login-form.php');
        return '';
    }else{
      header("Location: /");
      exit;
    }
  }
}