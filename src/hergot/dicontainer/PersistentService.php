<?php

namespace hergot\dicontainer;

use hergot\dicontainer\ServiceStorageInterface;

class PersistentService implements ServiceInterface {
    /**
     * @var callable
     */
    private $factory;

    /**
     * @var ServiceStorageInterface
     */
    private $storage;

    /**
     * Class constructor
     * 
     * @param callable $factoryCallback
     * @param \hergot\dicontainer\ServiceStorageInterface $storage
     */
    public function __construct(callable $factoryCallback, ServiceStorageInterface $storage) {
        $this->factory = $factoryCallback;
        $this->storage = $storage;
    }

    /**
     * Retrieve instance of service
     * 
     * @return mixed
     */
    public function getInstance() {
        $reflectionFunction = new \ReflectionFunction($this->factory);
        $key = preg_replace_callback("@\\\\(.)@", function($matches) { 
                return \strtoupper($matches[1]);             
            }, get_class($this)) . '_' . md5($reflectionFunction->getFileName() 
                    . $reflectionFunction->getEndLine());
        $storedContent = $this->storage->read($key);
        if ($storedContent !== null) {
            $service = unserialize($storedContent);
        } else {
            $service = call_user_func($this->factory);
            $this->storage->write($key, serialize($service));
        }
        return $service;
    }
}