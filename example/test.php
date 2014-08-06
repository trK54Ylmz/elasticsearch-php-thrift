<?php
$elasticsearch = new ElasticSearch();

if (!$elasticsearch->isConnected()) {
    echo 'PHP couldn\'t connect to Elasticsearch';
    exit;
}

