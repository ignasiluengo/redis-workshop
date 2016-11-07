<?php

require_once __DIR__ . '/connection.php';
$limit = 10000;

// EXAMPLE 1
$benchmark = new \UCSDMath\Testing\Benchmark();
$benchmark->start();
foreach (range(1, $limit) as $i) {
    $key = 'data_'. $i;
    $client->set($key, $i);
    $client->expire($key, 10);
    $client->incr('counter');
    $client->sadd('members', $key);
}
echo $benchmark->stop();
$client->flushdb();

//EXAMPLE 2
$benchmark->start();
foreach (range(1, $limit) as $i) {
    $key = 'data_'. $i;
    $client->setex($key, 10, $i);
    $client->incr('counter');
    $client->sadd('members', $key);
}

echo $benchmark->stop();
$client->flushdb();

//EXAMPLE 3
$benchmark->start();
foreach (range(1, $limit) as $i) {
    $client->pipeline(function($pipe) use ($i) {
        $key = 'data_'. $i;
        $pipe->setex($key, 10, $i);
        $pipe->incr('counter');
        $pipe->sadd('set', $key);
    });
}
echo $benchmark->stop();
$client->flushdb();


