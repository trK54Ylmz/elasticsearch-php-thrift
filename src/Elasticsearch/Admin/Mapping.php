<?php
namespace Elasticsearch\Admin;

class Mapping
{
    const STRING = 'string';
    const INTEGER = 'integer';
    const LONG = 'long';
    const FLOAT = 'float';
    const DOUBLE = 'double';
    const BOOLEAN = 'boolean';
    const BINARY = 'binary';
    const ARRAYTYPE = 'array';

    protected $map = array();

    public function addField($name, $type = self::STRING, $options = array()) {
        $this->map[$name] = array_merge(array('type' => $type), $options);
    }

    public function getMapping() {
        return array('properties' => $this->map);
    }
} 