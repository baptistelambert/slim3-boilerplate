<?php

$container = $app->getContainer();

$container['view'] = function ($container) {
    $dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir . '/src/views', [
        'cache' => $container->get('settings')['debug'] ? false : $dir . '/tmp/cache',
        'debug' => $container->get('settings')['debug']
    ]);

    if ($container->get('settings')['debug']) {
        $view->addExtension(new Twig_Extension_Debug());
    }

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// Controllers

$container['DefaultController'] = function ($container) {
    return new \Src\Controllers\DefaultController($container);
};