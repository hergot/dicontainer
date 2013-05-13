<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetInstance() {
        $counter = 0;
        $service = new Service(function() use (&$counter) { $counter++; return $counter; });
        $this->assertEquals('1', $service->getInstance());
        $this->assertEquals('2', $service->getInstance());
    }    
}
