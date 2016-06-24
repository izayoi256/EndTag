#!/usr/bin/env php
<?php
#require_once("vendor/autoload.php");
(@include_once __DIR__ . '/../../../vendor/autoload.php') || @include_once __DIR__ . '/../../../../../autoload.php';

set_time_limit(0);

$app = \Eccube\Application::getInstance();
$app->initialize();
$app->initializePlugin();

// Console
$app->register(
    new \Knp\Provider\ConsoleServiceProvider(),
    array(
        'console.name' => 'BlankPlugin',
        'console.version' => \Plugin\BlankPlugin\Common\Constant::VERSION,
        'console.project_directory' => __DIR__ . "/../../.."
    )
);

$console = $app["console"];
$console->add(new Plugin\BlankPlugin\Command\BlankCommand($app));

$console->run();
