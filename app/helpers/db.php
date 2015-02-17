<?php
function getConnection($app) {
  try {
    $dbh = new PDO("mysql:host={$app->config('MYSQL_HOST')};dbname={$app->config('MYSQL_DATABASE')};charset=utf8", $app->config('MYSQL_USER'), $app->config('MYSQL_PASS'), array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $dbh;
  }catch(PDOException $e){
    print_r($e);
    die();
    $app->render(500,array(
      'msg' => 'Database Connection Error'
    ));
  }
}
