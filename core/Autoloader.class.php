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
        'App' => Constants::PROJECT_ROOT . 'core/' . 'App.class.php',
        'Button' => Constants::COMPONENTS_PATH . 'Button/' . 'Button.class.php',
        'Templater' => Constants::PROJECT_ROOT . 'core/' . 'Templater.class.php',
        'ObTemplater' => Constants::PROJECT_ROOT . 'core/' . 'ObTemplater.class.php',
        'ObjectStateValidator' => Constants::PROJECT_ROOT . 'core/' . 'ObjectStateValidator.interface.php',
        'Functional' => Constants::PROJECT_ROOT . 'core/' . 'Functional.class.php',
        'NameToFileMapper' => Constants::PROJECT_ROOT . 'core/' . 'NameToFileMapper.interface.php',
        'PhpViewTemplateNameToFileMapper' => Constants::PROJECT_ROOT . 'core/' . 'PhpViewTemplateNameToFileMapper.class.php',
        'ControlDevelopment' => Constants::COMPONENTS_PATH  . 'ControlDevelopment/' . 'ControlDevelopment.class.php',
        'Substitutor' => Constants::PROJECT_ROOT  . 'core/' . 'Substitutor.interface.php',
        'ObFileTemplateContextSubstitutor' => Constants::PROJECT_ROOT  . 'core/' . 'ObFileTemplateContextSubstitutor.class.php'
    ];

    private static function load($classname) {

        if (!key_exists($classname, self::$map) or !file_exists(self::$map[$classname])){
            throw new Exception('Класс не указан в карте или его файл не найден');
        }

        require_once self::$map[$classname];
    }

    public static function init() {

        spl_autoload_register(self::class . '::' . 'load');
    }
};

Autoloader::init();