<?php
require __DIR__ . '/vendor/autoload.php';

$elasticsearch = new Elasticsearch\Client();

if (!$elasticsearch->isConnected()) {
    echo 'PHP couldn\'t connect to Elasticsearch';
    exit;
}

$body = '{
    "query" : {
        "match_all" : {}
    }
}';

$index = 'twitter';
$type = 'users';

$elasticsearch->setType($type);
$elasticsearch->setIndex($index);
$elasticsearch->setBody($body);

$result = $elasticsearch->search();

var_dump($result);

$elasticsearch->Close();