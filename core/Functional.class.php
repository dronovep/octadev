<?php
/**
 * Функционал - это функция, реализованная через класс.
 * Создание функционала, вызов его метода call с передачей соответствующей ДТО - равносильно вызову функции с определенным перечнем аргументов
 * Преимущество функционала в том, что класс более гибок, как языковая единица, также вместо списка аргументов используется строго типизированная DTO
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 22:37
 */

abstract class Functional {

    protected static $dto_type = '';

    protected final function checkDTOTypeExistense(DTO $dto) {

        try {
            class_exists(static::$dto_type);
        } catch(Exception $e) {
            $exception_generator = StandartExceptionGenerator::getSingleton();
            $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                ['dto_type' => static::$dto_type],
                "dto_type_doesn't_exist"
            );
        }
    }

    protected final function checkDTOCorrespondsItsType(DTO $dto) {

        if (!($dto instanceof static::$dto_type)) {
            $exception_generator = StandartExceptionGenerator::getSingleton();
            $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                ['dto_type' => static::$dto_type],
                "dto_value_wrong_type"
            );
        }
    }

    protected abstract function execute(DTO $dto);

    public function call(DTO $dto) {
        $this->checkDTOTypeExistense($dto);
        $this->checkDTOCorrespondsItsType($dto);
        $dto->validate();
        return $this->execute($dto);
    }
}