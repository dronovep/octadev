<?php
/**
 * autoloader.php
 * User: Евгений Дронов
 * Date: 22.10.2020
 * Time: 14:14
 */

class Constants {
    /** @var string корневая папка проекта */
    const PROJECT_ROOT = '/var/www/html/octadev.ru/';

    const MODULES_PATH = self::PROJECT_ROOT . 'backend_modules/';

    /** @var string Папка с gui компонентами */
    const COMPONENTS_PATH = self::PROJECT_ROOT . 'components/';

    /* @var string путь к web-публичной папке приложения относительно корня  */
    const WEB_PATH = self::PROJECT_ROOT .'public/';

    /** @var string путь к папке, содержащей шаблоны различных gui элементов приложения */
    const HTML_TEMPLATES_PATH = self::PROJECT_ROOT . 'html_templates/';

    const ERROR_MESSAGE_TEMPLATES_PATH = self::PROJECT_ROOT . 'error_message_templates/';

    const PHP_ELEMENTARY_TYPES = [
        'int',
        'bool',
        'float',
        'string',
        'array'
    ];
};

class Autoloader {

    private static $class_to_module_map = [
        'Constants'                             => Constants::MODULES_PATH . 'autoloader.php',
        'Autoloader'                            => Constants::MODULES_PATH . 'autoloader.php',
        'Environment'                           => Constants::MODULES_PATH . 'core.php',
        'NameToFileMapper'                      => Constants::MODULES_PATH . 'core.php',
        'ErrorMessageTemplateNameToFileMapper'  => Constants::MODULES_PATH . 'core.php',
        'GenericExceptionGenerator'             => Constants::MODULES_PATH . 'core.php',
        'Singleton'                             => Constants::MODULES_PATH . 'core.php',
        'StandardExceptionGenerator'            => Constants::MODULES_PATH . 'core.php',
        'DTO'                                   => Constants::MODULES_PATH . 'core.php',
        'FileTemplateDTO'                       => Constants::MODULES_PATH . 'core.php',
        'Functional'                            => Constants::MODULES_PATH . 'core.php',
        'PhpViewTemplateNameToFileMapper'       => Constants::MODULES_PATH . 'core.php',
        'FileTemplateHtmlRenderer'              => Constants::MODULES_PATH . 'core.php',
        'EntrancePoint'                         => Constants::MODULES_PATH . 'core.php',
        'DatabaseRequisites'                    => Constants::MODULES_PATH . 'database/DatabaseRequisites.class.php',
        'Button'                                => Constants::MODULES_PATH . 'gui_components.php',
        'ControlDevelopment'                    => Constants::MODULES_PATH . 'gui_components.php',
    ];

    private static function load($classname) {

        if (!key_exists($classname, self::$class_to_module_map) or !file_exists(self::$class_to_module_map[$classname])){
            throw new Exception("Класс $classname не указан в карте или его файл не найден");
        }

        require_once self::$class_to_module_map[$classname];
    }

    public static function init() {

        spl_autoload_register(self::class . '::' . 'load');
    }
};
Autoloader::init();