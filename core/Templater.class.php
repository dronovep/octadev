<?php
/**
 * Абстрактный класс шаблонизатора
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 14:53
 */

abstract class Templater extends Functional {

    const SIGNATURE = [
        'context' => 'array',
        'template' => 'string',
        'template_name_to_file_mapper' => 'NameToFileMapper',
        'context_substitutor' => 'Substitutor'
    ];

    protected final function findTemplateFile(): string {

        $template = $this->template;
        $template_file = $this->template_name_to_file_mapper->map($template);
        if (!file_exists($template_file)) {
            throw new Exception("Не найден файл $template_file для указанного имени шаблона $template");
        }

        return $template_file;
    }

    protected final function execute() {
        $template_file = $this->findTemplateFile();
        return $this->context_substitutor->substitute($this->context, $template_file);
    }
}