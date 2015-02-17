<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

$defaultConfig = array(
  'templates.path' => __DIR__.'/templates',
  'debug' => false,
  'view' => new \Slim\Views\Twig()
);

$config = array_merge($defaultConfig, require __DIR__.'/../.env.php');

$app = new \Slim\Slim($config);

function authenticate(\Slim\Route $route) {
    $app = \Slim\Slim::getInstance();
    if (!$_SESSION['id']) {
      $app->render(401,array(
        'msg' => 'Not Logged In'
      ));
    }
    return true;
}

require __DIR__.'/helpers/db.php';

require __DIR__.'/security.php';

require __DIR__.'/routes.php';

return $app;