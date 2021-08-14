<?php

namespace mapp\database\connection_implementations;

use mapp\database\Connector;
use mapp\database\Requisites;
use PDO;

class PDOConnection extends Connector
{
    /** @var PDO */
    private $pdo;

    protected final function __construct(Requisites $requisites)
    {
        $driver = $requisites->getDriverType();
        $host = $requisites->getHost();
        $port = $requisites->getPort();
        $dbname = $requisites->getDBName();
        $username = $requisites->getUserName();
        $password = $requisites->getPassword();

        $this->pdo = new PDO("$driver:host=$host;port=$port;dbname=$dbname;user=$username;password=$password");
    }

    protected final function close() :void
    {
        unset($this->pdo);
    }

    public final function executeQuery(string $query) :array
    {
        return $this->pdo->query($query, PDO::FETCH_ASSOC)->fetchAll();
    }
}