<?php

require_once(dirname(__FILE__) . '/utilities/utilities.php');

$config = [
  'DB_USER' => 'USER',
  'DB_PASS' => 'PASS',
  'DB_HOST' => 'localhost',
  'DB_NAME' => 'NAME',
  'AUTH_SALT' => 'RANDOM SALT'
];

dotEnv($config);

return $config;