<?php

namespace mapp\database;

abstract class Connection
{
    public abstract function executeQuery(string $query) :array;

    protected abstract function close() :void;
}