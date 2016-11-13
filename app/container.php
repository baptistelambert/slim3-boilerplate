<?php

$container = $app->getContainer();

// Twig
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

// Doctrine Entity Manager
$container['em'] = function ($container) {
    $settings = $container->get('settings')['doctrine'];

    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['meta']['entity_path'],
        $settings['meta']['auto_generate_proxies'],
        $settings['meta']['proxy_dir'],
        $settings['meta']['cache'],
        false
    );

    return \Doctrine\ORM\EntityManager::create($settings['connection'], $config);
};

// Helpers

$container['validator'] = function ($container) {
    return new \Src\Helpers\Validator\Validator;
};

\Respect\Validation\Validator::with('Src\\Helpers\\Validator\\Rules\\'); // register custom rules for the validator

// Controllers

$container['DefaultController'] = function ($container) {
    return new \Src\Controllers\DefaultController($container);
};

$container['BookController'] = function ($container) {
    return new \Src\Controllers\BookController($container);
};

$container['AuthController'] = function ($container) {
    return new \Src\Controllers\AuthController($container);
};