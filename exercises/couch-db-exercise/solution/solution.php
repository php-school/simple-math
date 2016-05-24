<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\CouchDB\CouchDBClient;

$client = CouchDBClient::create(['dbname' => $argv[1]]);
$doc = $client->findDocument($argv[2])->body;

$total = array_sum($doc['numbers']);
$doc['total'] = $total;
$client->putDocument(['total' => $total, 'numbers' => $doc['numbers']], $argv[2], $doc['_rev']);
echo $total;
