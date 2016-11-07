<?php

date_default_timezone_set('UTC');
require_once __DIR__ . '/connection.php';

$globalBadges = [
    'facebook' => 3,
    'twitter' => 2,
    'linkedin' => 1,
    'first_purchase' => 5,
    'register' => 10,
    'comment' => 1
];

$client->sadd('badges', array_keys($globalBadges));

$client->sadd('user:1:badges', 'facebook', 'first_purchase', 'register');

$badgeUser = $client->sdiff(['badges', 'user:1:badges']);
var_dump($badgeUser);

$client->flushdb();