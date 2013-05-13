<?php

namespace hergot\dicontainer;

class APCServiceStorage implements ServiceStorageInterface {
    
    /**
     * Read from apc for specified key
     * 
     * @param string $key
     * @return string|null
     */
    public function read($key) {
        $result = \apc_fetch($key);
        return $result === false ? null : $result;
    }
    
    /**
     * Write data to apc
     * 
     * @param string $key
     * @param string $data
     * @throws \RuntimeException
     */
    public function write($key, $data) {
        if (\apc_store($key, $data) !== true) {
            throw new \RuntimeException('Cannot store data to APC.');
        }
    }

}