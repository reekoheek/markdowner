<?php

require '../vendor/autoload.php';

$app = new \Markdowner\App(array(
    'templates.path' => '../templates',
));

$app->run();

