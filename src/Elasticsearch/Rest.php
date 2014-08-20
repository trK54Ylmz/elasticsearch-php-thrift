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


interface RestIf
{
    /**
     * @param \Elasticsearch\RestRequest $request
     * @return \Elasticsearch\RestResponse
     */
    public function execute(\Elasticsearch\RestRequest $request);
}

class RestClient implements \Elasticsearch\RestIf
{
    protected $input_ = null;
    protected $output_ = null;

    protected $seqid_ = 0;

    public function __construct($input, $output = null)
    {
        $this->input_ = $input;
        $this->output_ = $output ? $output : $input;
    }

    public function execute(\Elasticsearch\RestRequest $request) {
        $this->send_execute($request);
        return $this->recv_execute();
    }

    public function send_execute(\Elasticsearch\RestRequest $request) {
        $args = new \Elasticsearch\Rest_execute_args();
        $args->request = $request;
        $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
        if ($bin_accel) {
            thrift_protocol_write_binary($this->output_, 'execute', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
        } else {
            $this->output_->writeMessageBegin('execute', TMessageType::CALL, $this->seqid_);
            $args->write($this->output_);
            $this->output_->writeMessageEnd();
            $this->output_->getTransport()->flush();
        }
    }

    public function recv_execute() {
        $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
        if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Elasticsearch\Rest_execute_result', $this->input_->isStrictRead());
        else {
            $rseqid = 0;
            $fname = null;
            $mtype = 0;

            $this->input_->readMessageBegin($fname, $mtype, $rseqid);
            if ($mtype == TMessageType::EXCEPTION) {
                $x = new TApplicationException();
                $x->read($this->input_);
                $this->input_->readMessageEnd();
                throw $x;
            }
            $result = new \Elasticsearch\Rest_execute_result();
            $result->read($this->input_);
            $this->input_->readMessageEnd();
        }
        if ($result->success !== null) {
            return $result->success;
        }
        throw new \Exception("execute failed: unknown result");
    }

}

// HELPER FUNCTIONS AND STRUCTURES

class Rest_execute_args extends TBase
{
    static $_TSPEC;

    /**
     * @var \Elasticsearch\RestRequest
     */
    public $request = null;

    public function __construct($vals = null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                1 => array(
                    'var' => 'request',
                    'type' => TType::STRUCT,
                    'class' => '\Elasticsearch\RestRequest',
                ),
            );
        }
        if (is_array($vals)) {
            parent::__construct(self::$_TSPEC, $vals);
        }
    }

    public function getName() {
        return 'Rest_execute_args';
    }

    public function read($input) {
        return $this->_read('Rest_execute_args', self::$_TSPEC, $input);
    }

    public function write($output) {
        return $this->_write('Rest_execute_args', self::$_TSPEC, $output);
    }
}

class Rest_execute_result extends TBase
{
    static $_TSPEC;

    /**
     * @var \Elasticsearch\RestResponse
     */
    public $success = null;

    public function __construct($vals = null) {
        if (!isset(self::$_TSPEC)) {
            self::$_TSPEC = array(
                0 => array(
                    'var' => 'success',
                    'type' => TType::STRUCT,
                    'class' => '\Elasticsearch\RestResponse',
                ),
            );
        }
        if (is_array($vals)) {
            parent::__construct(self::$_TSPEC, $vals);
        }
    }

    public function getName() {
        return 'Rest_execute_result';
    }

    public function read($input) {
        return $this->_read('Rest_execute_result', self::$_TSPEC, $input);
    }

    public function write($output) {
        return $this->_write('Rest_execute_result', self::$_TSPEC, $output);
    }
}