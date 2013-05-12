<?php

namespace hergot\dicontainer;

class FileServiceStorage implements ServiceStorageInterface {
    /**
     * @var string
     */
    private $directory;

    /**
     * Class constructor
     * 
     * @param string $directory
     */
    public function __construct($directory) {
        $this->directory = $directory;
    }
    
    /**
     * Read from file filesystem for specified key
     * 
     * @param string $key
     * @return mixed
     */
    public function read($key) {
        $filename = $this->directory . '/' . $key;
        if (file_exists($filename)) {
            return unserialize(file_get_contents($filename));
        }
        return null;
    }
    
    /**
     * Write file to filesystem for specified key with appropriate content
     * 
     * @param string $key
     * @param mixed $data
     */
    public function write($key, $data) {
        $filename = $this->directory . '/' . $key;
        file_put_contents($filename, serialize($data));
    }

}