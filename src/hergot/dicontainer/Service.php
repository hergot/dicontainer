<?php

namespace hergot\dicontainer;

class Service implements ServiceInterface {
    /**
     * @var callable
     */
    private $factory;

    /**
     * Class constructor
     * 
     * @param callable $factoryCallback
     */
    public function __construct(callable $factoryCallback) {
        $this->factory = $factoryCallback;
    }

    /**
     * Retrieve service instance
     * 
     * @return mixed
     */
    public function getInstance() {
        return \call_user_func($this->factory);
    }
}