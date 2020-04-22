<?php

class Router {
  public function get(String $path = '/', $callback = null, $middleware = null){
    if($path === $_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_METHOD'] === 'GET'){
      $auth = true;
      if(is_callable($middleware)){
        $auth = $middleware();
        if(!$auth){
          $this->sendResponse('Not Authorized', [], 401);
        }
      }
      
      if($auth && is_callable($callback)){
        $body = $callback();
        $this->sendResponse($body);
      }
    }
  }

  public function post(String $path = '/', $callback = null, $middleware = null){
    if($path === $_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_METHOD'] === 'POST'){
      $auth = true;
      if(is_callable($middleware)){
        $auth = $middleware();
        if(!$auth){
          $this->sendResponse('Not Authorized', [], 401);
        }
      }
      
      if($auth && is_callable($callback)){
        $body = $callback();
        $this->sendResponse($body);
      }
    }
  }

  public function sendResponse(String $body = '', Array $headers = [], int $code = 200){
    foreach($headers as $k => $v){
      header(sprintf("%s: %s", $k, $v));
    }
    http_response_code($code);
    echo $body;
    exit;
  }
}