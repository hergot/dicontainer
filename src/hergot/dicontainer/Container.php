<?php

namespace hergot\dicontainer;

class Container {
    /**
     * @var array
     */
    private $services;

    /**
     * Class constructor
     */
    public function __construct() {
        $this->services = array();
    }
    
    /**
     * Set service in container
     * 
     * @param string $id
     * @param \hergot\dicontainer\ServiceInterface $service
     */
    public function setService($id, ServiceInterface $service) {
        $this->services[$id] = $service;
    }
    
    /**
     * Get service from container
     * 
     * @param string $id
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getService($id) {
        if (isset($this->services[$id])) {
            return $this->services[$id]->getInstance();
        }
        throw new \InvalidArgumentException('Service "' . $id . '" not found');
    }
}