<?php
/**
 * Глобальные константы приложения
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 9:45
 */

class Constants {
    /** @var string корневая папка проекта */
    const PROJECT_ROOT = '/var/www/html/octadev.ru/';

    /** @var string Папка с gui компонентами */
    const COMPONENTS_PATH = self::PROJECT_ROOT . 'components/';

    /* @var string путь к web-публичной папке приложения относительно корня  */
    const WEB_PATH = self::PROJECT_ROOT .'public/';
};