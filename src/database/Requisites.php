<?php

namespace mapp\database;

abstract class Requisites
{
    public abstract function getDriverType() :string;
    public abstract function getHost() :string;
    public abstract function getPort() :string;
    public abstract function getDBName() :string;
    public abstract function getUserName() :string;
    public abstract function getPassword() :string;
}