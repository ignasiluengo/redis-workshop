<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/connection.php';
$totalPointsBadges = 22;

$usersScore = [];
foreach (range(1, 100000) as $i) {
    $key = sprintf("user:%s:badges:score", $i);
    $usersScore[$key] = rand(0, $totalPointsBadges);
}

$client->zadd('badges:leaderboard', $usersScore);

$benchmark = new \UCSDMath\Testing\Benchmark();
$benchmark->start();

$board = $client->zrevrange('badges:leaderboard', 0, 9, ['withscores' => true]);
var_dump($board);
echo $benchmark->stop();

// $client->flushdb();