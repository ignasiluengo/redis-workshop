<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/connection.php';

$globalBadges = [
    'register' => 10,
    'first_purchase' => 5,
    'facebook' => 3,
    'twitter' => 2,
    'linkedin' => 1,
    'comment' => 1
];

$totalPointsBadges = 22;

$client->sadd('badges', array_keys($globalBadges));
$client->sadd('user:1:badges', 'facebook', 'twitter', 'first_purchase', 'register'); // 20
$client->sadd('user:2:badges', 'facebook', 'first_purchase', 'register'); // 18
$client->sadd('user:3:badges', 'register'); // 10
$client->sadd('user:4:badges', 'facebook', 'twitter', 'linkedin', 'first_purchase', 'register'); // 21

$usersScore = [
    'user:1:badges:score' => 20,
    'user:2:badges:score' => 18,
    'user:3:badges:score' => 10,
    'user:4:badges:score' => 21,
];


$client->zadd('badges:leaderboard', $usersScore);
$board = $client->zrevrange('badges:leaderboard', 0, 1, ['withscores' => true]);
var_dump($board);

$client->flushdb();