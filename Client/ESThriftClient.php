<?php
require_once __DIR__. '/Thrift/ClassLoader/ThriftClassLoader.php';

use Thrift\ClassLoader\ThriftClassLoader;

$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__);
$loader->registerDefinition('Elasticsearch', __DIR__);
$loader->register();

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

use Elasticsearch\RestRequest;
use Elasticsearch\RestResponse;
use Elasticsearch\Method;

use Elasticsearch\RestClient as ESRest;

class ESThriftClient
{
    protected $client;
    protected $socket;
    protected $transport;
    protected $connected;

    public function __construct($host = 'localhost', $port = 9500){
        try{
            $this->socket = new TSocket($host, $port);
            $this->transport = new TBufferedTransport($this->socket, 1024, 1024);
            $protocol = new TBinaryProtocol($this->transport);
            $this->client = new ESRest($protocol);
            $this->transport->open();
            $this->connected = true;
        }catch(TException $e){
            $this->connected = false;
        }
    }

    public function isConnected(){
        return $this->connected;
    }

    public function sendRequest($body = null, $uri = null, $method = Method::POST){
        try{
            $r = new RestRequest();
            $r->method = $method;
            $r->uri = $uri;
            $r->body = $body;
            return $this->client->execute($r);
        }catch(TException $e){
            $response = new RestResponse();
            $response->status = 404;
            return $response;
        }
    }

    public function Close(){
        if($this->connected){
            $this->client = null;
            $this->transport->close();
            $this->socket->close();
            $this->connected = false;
        }
    }

    public function __destruct(){
        $this->Close();
    }
}
