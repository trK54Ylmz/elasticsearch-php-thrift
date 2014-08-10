<?php
namespace Elasticsearch\Core;

define('INCLUDEDIR', realpath(__DIR__ . '/../Namespaces/'));
define('STUBSDIR', realpath(__DIR__ . '/../../'));

require_once INCLUDEDIR . '/Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', INCLUDEDIR);
$loader->registerDefinition('Elasticsearch', STUBSDIR);
$loader->register();

use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

use Elasticsearch\RestClient;
use Elasticsearch\Method;
use Elasticsearch\RestRequest;
use Elasticsearch\RestResponse;
use Elasticsearch\Exception\TException as PHPTException;

class Core
{
    protected $client;
    protected $socket;
    protected $transport;
    protected $connected;

    protected $index;
    protected $type;
    protected $id;
    protected $body;

    public function __construct($host = 'localhost', $port = 9500) {
        try {
            $this->socket = new TSocket($host, $port);
            $this->transport = new TBufferedTransport($this->socket, 1024, 1024);
            $protocol = new TBinaryProtocolAccelerated($this->transport);
            $this->client = new RestClient($protocol);
            $this->transport->open();
            $this->connected = true;
        } catch(TException $e) {
            $this->connected = false;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIndex($index) {
        $this->index = $index;
    }

    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @param array|object $body Request body
     */
    public function setBody($body) {
        if (is_string($body)) {
            $this->body = $body;
        } else if (is_array($body)) {
            $this->body = json_encode($body);
        } else if (is_object($body)) {
            $this->body = json_encode((array)$body);
        }
    }

    protected function generateUrl($requestType, array $params = array()) {
        $url = '/';

        if ($this->index != null) {
            $url .= $this->index . '/';
        }

        if ($this->type != null) {
            $url .= $this->type . '/';
        }

        $url .= $requestType;

        if (isset($params[0])) {
            $_temp = array();

            $url .= '?';
            foreach ($params as $k => $v) {
                array_push($_temp, $k . '=' . $v);
            }

            $url .= implode('&', array_unique($_temp));
        }

        return $url;
    }

    /**
     * Check Thrift transport opened
     *
     * @return bool
     */
    public function isConnected() {
        return $this->connected;
    }

    /**
     * @param null $uri
     * @param int $method
     * @return RestResponse
     */
    public function sendRequest(&$uri, $method = Method::POST) {
        try {
            $r = new RestRequest();
            $r->method = $method;
            $r->uri = $uri;
            $r->body = $this->body;
            return $this->client->execute($r);
        } catch(TException $e) {
            $response = new RestResponse();
            $response->status = 404;
            return $response;
        }
    }

    public function parseResult(&$result) {
        if ($result instanceof RestResponse) {
            if ($result->status == 200) {
                $type = explode('; ', $result->headers['Content-Type']);
                if ($type[0] == 'application/json') {
                    return json_decode($result->body, true);
                }
            }

            if ($result->body != null) {
                throw new PHPTException($result->body);
            } else {
                throw new PHPTException('Elasticsearch doesn\'t work');
            }
        }

        throw new PHPTException('Result couldn\'t parse!');
    }

    /**
     * Close Elasticsearch client and Thrift transport connection
     */
    public function Close() {
        if($this->connected) {
            $this->client = null;
            $this->transport->close();
            $this->socket->close();
            $this->connected = false;
        }
    }

    public function __destruct() {
        $this->Close();
    }
}