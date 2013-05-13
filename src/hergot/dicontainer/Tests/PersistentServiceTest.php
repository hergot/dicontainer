<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\PersistentService;

class PersistentServiceTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetInstanceNotPersisted() {
        $storage = $this->getMock('\hergot\dicontainer\ServiceStorageInterface');
        $storage->expects($this->once())
                ->method('read')
                ->will($this->returnCallback(function($key) {
                    $keyPrefix = substr($key, 0, strpos($key, '_'));
                    $this->assertEquals('hergotDicontainerPersistentService', $keyPrefix);
                    return null;
                }));
        $callback = function() { return '1'; };
        $service = new PersistentService($callback, $storage);
        $this->assertEquals('1', $service->getInstance());
    }

    public function testGetInstancePersisted() {
        $storage = $this->getMock('\hergot\dicontainer\ServiceStorageInterface');
        $storage->expects($this->once())
                ->method('read')
                ->will($this->returnCallback(function($key) {
                    $keyPrefix = substr($key, 0, strpos($key, '_'));
                    $this->assertEquals('hergotDicontainerPersistentService', $keyPrefix);
                    return serialize('2');
                }));
        $callback = function() { return '1'; };
        $service = new PersistentService($callback, $storage);
        $this->assertEquals('2', $service->getInstance());
    }
    
}
