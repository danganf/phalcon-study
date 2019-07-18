<?php

use Phalcon\Mvc\MongoCollection;

class Author extends MongoCollection
{
    public $id;
    public $name;

    public function initialize()
    {
        $this->setSource("author");
    }

    public function getData($key = '')
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return null;
    }

    public function setData($key, $value = null)
    {
        if (!array_key_exists($key, $this->data) || $this->data[$key] !== $value) {
            $this->hasDataChanges = true;
        }
        $this->data[$key] = $value;
    }

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $key = $this->_underscore(substr($method, 3));
                $index = isset($args[0]) ? $args[0] : null;
                return $this->getData($key, $index);
            case 'set':
                $key = $this->_underscore(substr($method, 3));
                $value = isset($args[0]) ? $args[0] : null;
                return $this->setData($key, $value);
            case 'uns':
                $key = $this->_underscore(substr($method, 3));
                return $this->unsetData($key);
            case 'has':
                $key = $this->_underscore(substr($method, 3));
                return isset($this->data[$key]);
        }
        throw new Exception(
            sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
        );
    }

}
