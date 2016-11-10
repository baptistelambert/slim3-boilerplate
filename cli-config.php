<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__ . '/vendor/autoload.php';

$settings = include __DIR__ . '/app/settings.php';
$doctrine = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $doctrine['meta']['entity_path'],
    $doctrine['meta']['auto_generate_proxies'],
    $doctrine['meta']['proxy_dir'],
    $doctrine['meta']['cache'],
    false
);

$em = \Doctrine\ORM\EntityManager::create($doctrine['connection'], $config);

return ConsoleRunner::createHelperSet($em);