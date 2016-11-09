<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

// App instantiation
$settings = require __DIR__ . '/../app/settings.php';
$app = new \Slim\App($settings);

// Set up container
require __DIR__ . '/../app/container.php';

// Require middlewares
require __DIR__ . '/../app/middlewares.php';

// Require routes
require __DIR__ . '/../app/routes.php';

// Set up is done, let's run the app !
$app->run();