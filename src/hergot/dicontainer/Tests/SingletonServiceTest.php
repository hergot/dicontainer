<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\SingletonService;

class SingletonServiceTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetInstance() {
        $counter = 0;
        $service = new SingletonService(function() use (&$counter) { $counter++; return $counter; });
        $this->assertEquals('1', $service->getInstance());
        $this->assertEquals('1', $service->getInstance());
    }    
}
