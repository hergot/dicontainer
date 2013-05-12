<?php

namespace hergot\dicontainer;

class SingletonService implements ServiceInterface {
    /**
     * @var mixed
     */
    private $instance;

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
        $this->instance = null;
        $this->factory = $factoryCallback;
    }
    
    /**
     * Retrieve service instance
     * 
     * @return mixed
     */
    public function getInstance() {
        if ($this->instance === null) {
            $this->instance = \call_user_func($this->factory);
        }
        return $this->instance;
    }
}