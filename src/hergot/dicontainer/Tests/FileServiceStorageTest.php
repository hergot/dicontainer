<?php

namespace hergot\dicontainer\Tests;

use hergot\dicontainer\FileServiceStorage;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;

class FileServiceStorageTest extends \PHPUnit_Framework_TestCase {
    
    public function testRead() {
        $root = vfsStream::setup('root');
        $storage = new FileServiceStorage(vfsStream::url('root'));
        $this->assertNull($storage->read('test'));
        $file = new vfsStreamFile('test');
        $file->setContent(serialize('123'));
        $root->addChild($file);
        $this->assertEquals('123', $storage->read('test'));
    }

    public function testWrite() {
        $root = vfsStream::setup('root');
        $storage = new FileServiceStorage(vfsStream::url('root'));
        $this->assertFalse($root->hasChild('test'));
        $storage->write('test', '123');
        $this->assertTrue($root->hasChild('test'));
        $this->assertEquals(serialize('123'), $root->getChild('test')->getContent());
    }
    
}
