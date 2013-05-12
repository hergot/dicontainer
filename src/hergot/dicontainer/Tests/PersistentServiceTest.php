<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\PersistentService;

class PersistentServiceTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetInstanceNotPersisted() {
        $storage = $this->getMock('\hergot\dicontainer\ServiceStorageInterface');
        $storage->expects($this->once())
                ->method('read')
                ->will($this->returnCallback(function($key) {
                    $this->assertEquals('hergotDicontainerPersistentService_62f5cd474da4a0f71f9dcaa72f4de948', $key);
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
                    $this->assertEquals('hergotDicontainerPersistentService_5d91e4c8b97e9e9e0d5e658370307c63', $key);
                    return serialize('2');
                }));
        $callback = function() { return '1'; };
        $service = new PersistentService($callback, $storage);
        $this->assertEquals('2', $service->getInstance());
    }
    
}
