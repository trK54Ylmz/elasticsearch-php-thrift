<?php
namespace Elasticsearch;

class Client extends Core
{
    public function __construct($host = '127.0.0.1', $port = 9500) {
        parent::__construct($host, $port);
    }

    public function index() {
        $url = $this->generateUrl($this->id);
        $result = $this->sendRequest($url, Method::POST);

        return $this->parseResult($result);
    }

    public function search(array $params = array()) {
        $url = $this->generateUrl('/_search', $params);
        $result = $this->sendRequest($url, Method::POST);
        return $this->parseResult($result);
    }
}