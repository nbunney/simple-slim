<?php
  use Slim\Slim;
  use Slim\Extras\Views\Twig as Twig;


  /* Admin pages secured by authenticate middle ware */
  $app->get('/admin(/:subpage)', 'authenticate', function($subpage=false) use ($app) {

  });

  /* Special pages with specific routes */


  /* Standard DB Driven Pages */
  $app->get('/(:page(/:subpage))', function ($page=false, $subpage=false) use ($app) {
    //Only when we hit here do we pull our list of routes from the DB

    $db = getConnection($app);

    $app->render('index.html', array('test' => 'testing'));
  });
