<?php

namespace hergot\dicontainer;

interface ServiceStorageInterface {
    /**
     * Read service from backend
     * 
     * @param string $key
     * @return null|mixed
     */
    public function read($key);
    
    /**
     * Write service to backend
     * 
     * @param string $key
     * @param mixed $data
     */
    public function write($key, $data);
}