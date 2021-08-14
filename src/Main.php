<?php

namespace mapp;

use mapp\database\Connector;
use mapp\database\known_requisites\Octatest;

class Main
{
    public function run() : void {
        $connection = Connector::getForRequisites(new Octatest());

        $result = $connection->executeQuery(/** @lang PostgreSQL */"SELECT * FROM test.t_cars");
        Connector::disconnect($connection);

        var_dump($result);
    }
}