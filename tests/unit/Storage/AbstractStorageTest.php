<?php

namespace LeagueTests\Storage;

use LeagueTests\Stubs\StubAbstractServer;
use LeagueTests\Stubs\StubAbstractStorage;
use PHPUnit\Framework\TestCase;

class AbstractStorageTest extends TestCase
{
    public function testSetGet()
    {
        $storage = new StubAbstractStorage();

        $reflector = new \ReflectionClass($storage);
        $setMethod = $reflector->getMethod('setServer');
        $setMethod->setAccessible(true);
        $setMethod->invokeArgs($storage, [new StubAbstractServer()]);
        $getMethod = $reflector->getMethod('getServer');
        $getMethod->setAccessible(true);

        $this->assertTrue($getMethod->invoke($storage) instanceof StubAbstractServer);
    }
}
