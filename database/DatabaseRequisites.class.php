<?php
/**
 * Класс реквизитов подклбчения к БД в этом приложении
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 10:19
 */

class DatabaseRequisites {

    const DRIVER = 'pgsql';

    const DBNAME = 'octatest';

    const PORT = '32170';

    const DSN = self::DRIVER . ':' . 'dbname' . '=' . self::DBNAME . ';' . 'port' . '=' . self::PORT;

    const USER = 'octadev';

    const PASSWORD = 'Zk.,k.Lfie91';
};