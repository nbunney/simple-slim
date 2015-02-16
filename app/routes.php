<?php
  use Slim\Slim;
  use Slim\Extras\Views\Twig as Twig;


  /* Admin pages secured by authenticate middle ware */
  $app->get('/admin(/:subpage)', 'authenticate', function($subpage=false) use ($app) {

  });

  /* Special pages with specific routes */


  /* Standard DB Driven Pages */
  $app->get('/(:page(/:subpage))', function ($page=false, $subpage=false) use ($app) {

    $app->render('index.html', array('test' => 'testing'));
  });
