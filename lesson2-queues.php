<?php

require_once __DIR__ . '/connection.php';


$job = new stdClass();
$job->id = 1;
$job->name = 'normal_msg_1';
$client->rpush('queue.priority.normal', json_encode($job));


$job = new stdClass();
$job->id = 1;
$job->name = 'high_msg_1';
$client->rpush('queue.priority.high', json_encode($job));

$job = new stdClass();
$job->id = 2;
$job->name = 'high_msg_2';
$client->rpush('queue.priority.high', json_encode($job));


$job = new stdClass();
$job->id = 1;
$job->name = 'low_msg_1';
$client->rpush('queue.priority.low', json_encode($job));


$dateLimit = new \DateTime();
$dateLimit->modify('+ 30 seconds');
while(new \DateTime() < $dateLimit ) {
    $job = $client->blpop(
        'queue.priority.high'
        , 'queue.priority.normal'
        , 'queue.priority.low'
        , 10
    );

    if ($job) {
        echo sprintf("received queue: %s with message: %s", $job[0], $job[1]). "\n";
        sleep(3);
    }
}
