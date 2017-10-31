<?php

require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 'On');
$app = new rm\rmApp();
$app['debug'] = true;
$app->run();
