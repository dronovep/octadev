<?php

namespace mapp\database;

use Exception;
use mapp\database\connection_implementations\PDOConnection;

abstract class Connector extends Connection
{

    protected abstract function __construct(Requisites $requisites);
    protected abstract function close() :void;

    public static function getForRequisites(Requisites $requisites) :Connection
    {
        $connection_class = self::getConnectionClassForDriver($requisites->getDriverType());

        return new $connection_class($requisites);
    }

    private final static function getConnectionClassForDriver(string $driver_type) :string
    {
        if ($driver_type === DriverTypes::POSTGRESQL) {
            $connection_class = PDOConnection::class;
        } else {
            throw new Exception("Еще не реализован класс работы с БД для драйвера $driver_type");
        }

        return $connection_class;
    }

    public static function disconnect(Connection &$connection) :void
    {
        $connection->close();
        unset($connection);
    }
}