<?php

require_once(dirname(__FILE__) . '/utilities/Router.php');
require_once(dirname(__FILE__) . '/controllers/ApiController.php');
require_once(dirname(__FILE__) . '/controllers/AuthController.php');
require_once(dirname(__FILE__) . '/controllers/ViewController.php');
require_once(dirname(__FILE__) . '/controllers/TokenController.php');

$router = new Router();

$router->get('/api/user', ['ApiController', 'randomUser'], ['AuthController', 'authenticated']);
$router->get('/', ['ViewController', 'index']);
$router->get('/dashboard', ['ViewController', 'dashboard'], ['AuthController', 'authenticated']);
$router->get('/signup', ['ViewController', 'signup']);
$router->get('/login', ['ViewController', 'login']);
$router->get('/logout', ['ViewController', 'logout']);
$router->get('/tokens', ['ViewController', 'tokens'], ['AuthController', 'authenticated']);

$router->post('/tokens/delete', ['TokenController', 'delete'], ['AuthController', 'authenticated']);
$router->post('/tokens/create', ['TokenController', 'create'], ['AuthController', 'authenticated']);
$router->post('/signup', ['AuthController', 'webSignup']);
$router->post('/login', ['AuthController', 'webLogin']);


$router->get('/api/test', function(){
  return json_encode([$_SERVER, $_REQUEST, apache_request_headers()]);
});