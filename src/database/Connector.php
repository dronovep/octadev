<?php

namespace mapp\database;

use Exception;
use mapp\database\connection_implementations\PDOConnection;

abstract class Connector extends Connection
{

    protected abstract function __construct(Requisites $requisites);
    protected abstract function close() :void;

    public static function createConnectionForRequisites(Requisites $requisites) :Connection
    {
        $driver_type = $requisites->getDriverType();
        switch ($requisites->getDriverType()) {
            case DriverTypes::POSTGRESQL:
                $connection = new PDOConnection($requisites);
                break;

            default:
                throw new Exception("Еще не реализован класс работы с БД для драйвера $driver_type");
        }

        return $connection;
    }

    public static function disconnect(Connection &$connection) :void
    {
        $connection->close();
        unset($connection);
    }
}