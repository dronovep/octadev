<?php
/**
 * Преобразователь имени шаблона сообщения об ошибке в полное имя файла этого шаблона
 * User: Евгений Дронов
 * Date: 21.10.2020
 * Time: 9:19
 */

class ErrorMessageTemplateNameToFileMapper implements NameToFileMapper {

    public function map(string $template_name): string {
        return Constants::ERROR_MESSAGE_TEMPLATES_PATH . $template_name . '.php';
    }
}