<?php

require_once  'vendor/autoload.php';
require_once 'data.php';

$parameters = [
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
];

$options = [
    'parameters' => ['database' => 10]
];

$client = new Predis\Client($parameters, $options);