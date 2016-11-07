<?php


function insertRows($client, $limit = 10000)
{
    $benchmark = new \UCSDMath\Testing\Benchmark();
    $benchmark->start();
    $data = [];
    foreach (range(1, $limit) as $item) {
        if (0 === ($item%5000)) {
            $client->mset($data);
            $data = [];
        }
        $data[sprintf("data_%s", $item)] = $item;
    }

    if (!empty($data)) {
        $client->mset($data);
    }

    echo $benchmark->stop();
}
