<?php

/**
 * Queremos una lista de usuarios que han visitado el hotel_mikado, esa lista
 * no debe de pasar de 50 máximo y de 10 usuarios para mostrar en la web
 */

define('LIST_LIMIT', 50);
define('LIST_LIMIT_WEB', 10);

require_once __DIR__ . '/connection.php';
// EXAMPLE 1
$benchmark = new \UCSDMath\Testing\Benchmark();
$benchmark->start();

foreach (range(1, 55) as $i) {
    $total = $client->lpush('hotel:mikado:last_visited', 'user_'. $i);
    $client->ltrim('hotel:mikado:last_visited', 0, LIST_LIMIT - 1);
}

echo "get last item for web page". "\n";
$result = $client->lrange('hotel:mikado:last_visited', 0, LIST_LIMIT_WEB - 1);
var_dump($result);

echo $benchmark->stop();
$client->flushdb();