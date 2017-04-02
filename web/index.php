<?php

require_once __DIR__.'/../vendor/autoload.php';

$dirConfig = __DIR__ .'/../config/';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../src/controllers.php';
$app->run();
