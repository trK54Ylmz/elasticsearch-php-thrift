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

    public function get() {
        $url = $this->generateUrl($this->id);
        $result = $this->sendRequest($url, Method::GET);

        return $this->parseResult($result);
    }

    public function mapping($mapping) {
        if ($this->index == null && $this->type == null) {
            throw new Exception('Please specify index and type names');
        }

        $url = $this->generateUrl('/_mapping');

        if ($mapping instanceof \Elasticsearch\Admin\Mapping) {
            $mapping = $mapping->getMapping();
        } else if (is_array($mapping)) {
            $mapping = array('properties' => $mapping);
        } else {
            return false;
        }

        $this->setBody(array($this->type => $mapping));
        $result = $this->sendRequest($url, Method::POST);

        return $this->parseResult($result);
    }
}