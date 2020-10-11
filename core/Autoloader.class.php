<?php
/**
 * Автозагрузчик классов PHP
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 10:00
 */

require_once '../core/Constants.class.php';

class Autoloader {

    private static $map = [
        'Constants'  =>  Constants::PROJECT_ROOT        . 'core/' . 'Constants.class.php',
        'Autoloader'  => Constants::PROJECT_ROOT        . 'core/' . 'Autoloader.class.php',
        'Environment' => Constants::PROJECT_ROOT        . 'core/' . 'Environment.class.php',
        'DatabaseRequisites' => Constants::PROJECT_ROOT . 'database/DatabaseRequisites.class.php',
        'App' => Constants::PROJECT_ROOT . 'core/' . 'App.class.php'
    ];

    private static function load($classname) {
        require_once self::$map[$classname];
    }

    public static function init() {

        spl_autoload_register(self::class . '::' . 'load');
    }
};

Autoloader::init();