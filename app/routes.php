<?php

// DefaultController
$app->get('/', 'DefaultController:index')->setName('homepage');
$app->get('/hello[/{name}]', 'DefaultController:hello')->setName('hello');

// BookController
$app->get('/books', 'BookController:index')->setName('books_index');
$app->get('/book/{id:[0-9]+}', 'BookController:book')->setName('book_view');

// Auth
$app->get('/signup', 'AuthController:getSignUp')->setName('user_signup');
$app->post('/signup', 'AuthController:postSignUp');

$app->get('/signin', 'AuthController:getSignIn')->setName('user_signin');
$app->post('/signin', 'AuthController:postSignIn');

$app->get('/signout', 'AuthController:getSignOut')->setName('user_signout');