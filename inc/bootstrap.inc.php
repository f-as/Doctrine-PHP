<?php

// Load config file
//require_once __DIR__ . '/../config/default-config.php';

// Use Composer autoloading
require_once __DIR__ . '/../vendor/autoload.php';

// Get Doctrine entity manager
//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
use Webmasters\Doctrine\Bootstrap;

/*
$proxyDir = null;
$cache = null;
$isSimpleMode = false;

$config = Setup::createAnnotationMetadataConfiguration(
    [$applicationOptions['entity_dir']],
    $applicationOptions['debug_mode'],
    $proxyDir,
    $cache,
    $isSimpleMode
);
*/
$applicationOptions = ['debug_mode' => true];

//$em = EntityManager::create($connectionOptions, $config);
$bootstrap = Bootstrap::getInstance(
        //$connectionOptions,
        //$applicationOptions
);

$em = $bootstrap->getEm();
