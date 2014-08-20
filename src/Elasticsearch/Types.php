<?php
namespace Elasticsearch;

use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

final class Method
{
    const GET = 0;
    const PUT = 1;
    const POST = 2;
    const DELETE = 3;
    const HEAD = 4;
    const OPTIONS = 5;
    static public $__names = array(
        0 => 'GET',
        1 => 'PUT',
        2 => 'POST',
        3 => 'DELETE',
        4 => 'HEAD',
        5 => 'OPTIONS',
    );
}

final class Status
{
    const CONT = 100;
    const SWITCHING_PROTOCOLS = 101;
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NON_AUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const MULTI_STATUS = 207;
    const MULTIPLE_CHOICES = 300;
    const MOVED_PERMANENTLY = 301;
    const FOUND = 302;
    const SEE_OTHER = 303;
    const NOT_MODIFIED = 304;
    const USE_PROXY = 305;
    const TEMPORARY_REDIRECT = 307;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTHENTICATION = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const REQUEST_ENTITY_TOO_LARGE = 413;
    const REQUEST_URI_TOO_LONG = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const REQUESTED_RANGE_NOT_SATISFIED = 416;
    const EXPECTATION_FAILED = 417;
    const UNPROCESSABLE_ENTITY = 422;
    const LOCKED = 423;
    const FAILED_DEPENDENCY = 424;
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const INSUFFICIENT_STORAGE = 506;
    static public $__names = array(
        100 => 'CONT',
        101 => 'SWITCHING_PROTOCOLS',
        200 => 'OK',
        201 => 'CREATED',
        202 => 'ACCEPTED',
        203 => 'NON_AUTHORITATIVE_INFORMATION',
        204 => 'NO_CONTENT',
        205 => 'RESET_CONTENT',
        206 => 'PARTIAL_CONTENT',
        207 => 'MULTI_STATUS',
        300 => 'MULTIPLE_CHOICES',
        301 => 'MOVED_PERMANENTLY',
        302 => 'FOUND',
        303 => 'SEE_OTHER',
        304 => 'NOT_MODIFIED',
        305 => 'USE_PROXY',
        307 => 'TEMPORARY_REDIRECT',
        400 => 'BAD_REQUEST',
        401 => 'UNAUTHORIZED',
        402 => 'PAYMENT_REQUIRED',
        403 => 'FORBIDDEN',
        404 => 'NOT_FOUND',
        405 => 'METHOD_NOT_ALLOWED',
        406 => 'NOT_ACCEPTABLE',
        407 => 'PROXY_AUTHENTICATION',
        408 => 'REQUEST_TIMEOUT',
        409 => 'CONFLICT',
        410 => 'GONE',
        411 => 'LENGTH_REQUIRED',
        412 => 'PRECONDITION_FAILED',
        413 => 'REQUEST_ENTITY_TOO_LARGE',
        414 => 'REQUEST_URI_TOO_LONG',
        415 => 'UNSUPPORTED_MEDIA_TYPE',
        416 => 'REQUESTED_RANGE_NOT_SATISFIED',
        417 => 'EXPECTATION_FAILED',
        422 => 'UNPROCESSABLE_ENTITY',
        423 => 'LOCKED',
        424 => 'FAILED_DEPENDENCY',
        500 => 'INTERNAL_SERVER_ERROR',
        501 => 'NOT_IMPLEMENTED',
        502 => 'BAD_GATEWAY',
        503 => 'SERVICE_UNAVAILABLE',
        504 => 'GATEWAY_TIMEOUT',
        506 => 'INSUFFICIENT_STORAGE',
    );
}

class RestRequest extends TBase
{
    static $_TSPEC;

    /**
     * @var int
     */
    public $method = null;
    /**
     * @var string
     */
    public $uri = null;
    /**
     * @var array
     */
    public $parameters = null;
    /**
     * @var array
     */
    public $headers = null;
    /**
     * @var string
     */
    public $body = null;

    public function __construct($vals = null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                1 => array(
                    'var' => 'method',
                    'type' => TType::I32,
                ),
                2 => array(
                    'var' => 'uri',
                    'type' => TType::STRING,
                ),
                3 => array(
                    'var' => 'parameters',
                    'type' => TType::MAP,
                    'ktype' => TType::STRING,
                    'vtype' => TType::STRING,
                    'key' => array(
                        'type' => TType::STRING,
                    ),
                    'val' => array(
                        'type' => TType::STRING,
                    ),
                ),
                4 => array(
                    'var' => 'headers',
                    'type' => TType::MAP,
                    'ktype' => TType::STRING,
                    'vtype' => TType::STRING,
                    'key' => array(
                        'type' => TType::STRING,
                    ),
                    'val' => array(
                        'type' => TType::STRING,
                    ),
                ),
                5 => array(
                    'var' => 'body',
                    'type' => TType::STRING,
                ),
            );
        }
        if (is_array($vals)) {
            parent::__construct(self::$_TSPEC, $vals);
        }
    }

    public function getName() {
        return 'RestRequest';
    }

    public function read($input) {
        return $this->_read('RestRequest', self::$_TSPEC, $input);
    }

    public function write($output) {
        return $this->_write('RestRequest', self::$_TSPEC, $output);
    }
}

class RestResponse extends TBase
{
    static $_TSPEC;

    /**
     * @var int
     */
    public $status = null;
    /**
     * @var array
     */
    public $headers = null;
    /**
     * @var string
     */
    public $body = null;

    public function __construct($vals = null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                1 => array(
                    'var' => 'status',
                    'type' => TType::I32,
                ),
                2 => array(
                    'var' => 'headers',
                    'type' => TType::MAP,
                    'ktype' => TType::STRING,
                    'vtype' => TType::STRING,
                    'key' => array(
                        'type' => TType::STRING,
                    ),
                    'val' => array(
                        'type' => TType::STRING,
                    ),
                ),
                3 => array(
                    'var' => 'body',
                    'type' => TType::STRING,
                ),
            );
        }
        if (is_array($vals)) {
            parent::__construct(self::$_TSPEC, $vals);
        }
    }

    public function getName() {
        return 'RestResponse';
    }

    public function read($input) {
        return $this->_read('RestResponse', self::$_TSPEC, $input);
    }

    public function write($output) {
        return $this->_write('RestResponse', self::$_TSPEC, $output);
    }
}