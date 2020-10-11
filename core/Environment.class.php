<?php
/**
 * Класс для доступа к серверо-зависимым данным окружения
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 8:24
 */

class Environment {

    /* @var Environment - синглтон данного класса */
    private static $environment;

    /* @var string КОрневая папака проекта на сервере */
    private $project_dir;

    private function getProjectDir() {

        if (empty($this->project_dir)) {
            $this->project_dir = $_SERVER['MPROJECT_DIR'];
        }

        return $this->project_dir;
    }

    public static function ProjectDir() {

        if (empty(self::$environment)) {
            self::$environment = new self();
        }

        return self::$environment->getProjectDir();
    }
};