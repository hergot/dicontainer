<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\APCServiceStorage;

class APCServiceStorageTest extends \PHPUnit_Framework_TestCase {
    
    public function testRead() {
        $storage = new APCServiceStorage();
        $this->assertNull($storage->read('test'));
        \apc_store('test', '123');
        $this->assertEquals('123', $storage->read('test'));
    }

    public function testWrite() {
        $storage = new APCServiceStorage();
        \apc_delete('test');
        $this->assertFalse(\apc_fetch('test'));
        $storage->write('test', '123');
        $this->assertEquals('123', \apc_fetch('test'));
    }
    
}
