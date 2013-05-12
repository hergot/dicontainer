<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\Container;

class ContainerTest extends \PHPUnit_Framework_TestCase {
    
    public function testService() {
        $container = new Container();
        $service = $this->getMock('\hergot\dicontainer\ServiceInterface');
        $service->expects($this->once())
                ->method('getInstance')
                ->will($this->returnValue('testValue'));
        $container->setService('test', $service);
        $this->assertEquals('testValue', $container->getService('test'));
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetServiceNotFound() {
        $container = new Container();
        $container->getService('test');        
    }
    
}
