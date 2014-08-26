<?php
namespace Elasticsearch;

use Elasticsearch\Admin\Indices;
use Elasticsearch\Core\Core;
use Elasticsearch\Exception\TException;

class Client extends Core
{
    protected $indices;

    public function __construct(array $hosts = array(array('127.0.0.1', 9500))) {
        $node = array_rand($hosts);
        $size = count($node);

        if ($size == 0) {
            $node = array('127.0.0.1', 9500);
        }

        if ($size == 1) {
            $node[1] = 9500;
        } else if ($size != 2) {
            throw new TException('Invalid host and port information!');
        }

        parent::__construct($node[0], $node[1]);
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

    public function delete() {
        if (empty($this->id)) {
            throw new TException('Document id is empty! Please specify document id');
        }

        $url = $this->generateUrl($this->id);
        $result = $this->sendRequest($url, Method::DELETE);

        return $this->parseResult($result);
    }

    public function indices() {
        if ($this->indices == null) {
            $this->indices =& new Indices();
        }

        return $this->indices;
    }
}