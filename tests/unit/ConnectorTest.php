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
        $this->assertConnectionIsNotNull();
        $this->assertConnectionHasValidType();
    }

    public function testDisconnect()
    {
        Connector::disconnect($this->connection);
        $this->assertConnectionIsNull();
    }



    protected function _before(): void {
        $this->createConnection();
    }

    protected function _after(): void {
        $this->destroyConnection();
    }



    private function createConnection() :void
    {
        $this->connection = Connector::createConnectionForRequisites(new Octatest());
    }

    private function destroyConnection(): void
    {
        unset($this->connection);
    }

    private function assertConnectionIsNotNull() :void
    {
        $this->assertNotNull($this->connection);
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

    private function assertConnectionIsNull() :void
    {
        $this->assertEquals(null, $this->connection);
    }
}
