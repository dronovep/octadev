<?php

namespace mapp\tests\unit;

use Codeception\Test\Unit;
use mapp\database\Connection;
use mapp\database\Connector;
use mapp\database\known_requisites\Octatest;

class ConnectorTest extends Unit
{

    /** @var Connection */
    private $connection;

    public function testCreateConnectionForRequisites() :void
    {
        $this->createConnection();
        $this->assertConnectionIsNotEmpty();
        $this->assertConnectionHasValidType();
        $this->assertCarWithFirstIdIsSorento();
    }

    public function testDisconnect()
    {
        $this->createConnection();
        Connector::disconnect($this->connection);
        $this->assertConnectionIsNullNow();
    }

    private function createConnection() :void
    {
        $this->connection = Connector::createConnectionForRequisites(new Octatest());
    }

    private function assertConnectionIsNotEmpty() :void
    {
        $this->assertNotEquals(null, $this->connection);
    }

    private function assertConnectionHasValidType() :void
    {
        $this->assertInstanceOf(Connection::class, $this->connection);
    }

    private function assertCarWithFirstIdIsSorento() :void
    {
        $data = $this->connection->executeQuery(/** @lang PostgreSQL */'SELECT model FROM test.t_cars WHERE id = 1');
        $this->assertEquals('Sorento', $data[0]['model']);
    }

    private function assertConnectionIsNullNow() :void
    {
        $this->assertEquals(null, $this->connection);
    }
}
