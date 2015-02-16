<?php

ini_set('display_errors', 1);

// Require composer dependencies
require __DIR__.'/../vendor/autoload.php';

// Instantiate the app
$app = require_once __DIR__.'/../app/start.php';

// AAAND run it!!!
$app->run();