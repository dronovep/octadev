<?php

namespace mapp\database\known_requisites;

use mapp\database\Requisites;

class Octatest extends Requisites
{
    public function getDriverType() :string
    {
        return 'pgsql';
    }

    public function getHost() :string
    {
        return 'localhost';
    }

    public function getPort() :string
    {
        return '32170';
    }

    public function getDBName() :string
    {
        return 'octatest';
    }

    public function getUserName() :string
    {
        return 'octadev';
    }

    public function getPassword() :string
    {
        return 'Zk.,k.Lfie91';
    }
}