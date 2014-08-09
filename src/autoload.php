<?php
if (class_exists('Elasticsearch')) {
    echo 'Duplicate include process or disable official Elasticsearch library';
    exit;
}

require_once __DIR__ . '/Core/Core.php';
require_once __DIR__ . '/Core/ElasticSearch.php';