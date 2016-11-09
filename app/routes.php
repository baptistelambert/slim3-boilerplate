<?php

$app->get('/', 'DefaultController:index')->setName('homepage');
$app->get('/hello[/{name}]', 'DefaultController:hello')->setName('hello');