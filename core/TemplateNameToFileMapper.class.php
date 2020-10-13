<?php
/**
 * Преобразователь имени шаблона в имя файла, содержащего этот шаблон
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 12:49
 */

class TemplateNameToFileMapper {

    public function map(string $template_name): string {
        return Constants::TEMPLATES_PATH . $template_name . '.php';
    }
}