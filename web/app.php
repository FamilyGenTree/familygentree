<?php

use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../vendor/autoload.php';
if (PHP_VERSION_ID < 70000) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

$setupFinsihed = file_exists(__DIR__ . '/../app/config/parameters.yml');
if (false === $setupFinsihed) {
    header('Location: /setup.php');
    exit(0);
}
$environment = $setupFinsihed ? 'prod' : 'setup';

$kernel = new AppKernel($environment, false);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
