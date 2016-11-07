<?php

require_once __DIR__ . '/connection.php';
$limit = 10000;
insertRows($client, $limit);

// EXAMPLE 1
$benchmark = new \UCSDMath\Testing\Benchmark();
$benchmark->start();
foreach (range(1, $limit) as $i) {
    $key = 'data_'. $i;
    if ($client->exists($key)) {
        $data = $client->get($key);
    } else {
        $client->set($key, $i);
    }
}
echo $benchmark->stop();


//EXAMPLE 2
$benchmark->start();
foreach (range(1, $limit) as $i) {
    $key = 'data_'. $i;
    $data = $client->get($key);
    if (!$data) {
        $client->set($key, $i);
    }
}

echo $benchmark->stop();
$client->flushdb();
