<?php
/**
 * Стандартный часто  используемый генератор исключений, который использует ErrorMessageTemplateNameToFileMapper
 * User: Евгений Дронов
 * Date: 21.10.2020
 * Time: 10:03
 */

class StandartExceptionGenerator extends GenericExceptionGenerator implements Singleton {

    private static $singleton;

    public function __construct() {
        parent::__construct(new ErrorMessageTemplateNameToFileMapper());
    }

    public static function getSingleton()
    {
        if (is_null(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}