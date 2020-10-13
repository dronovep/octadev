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
        'template_name_to_file_mapper' => 'NameToFileMapper'
    ];

    protected $template_file;

    protected final function findTemplateFile() {
        $template = $this->template;
        $this->template_file = $this->template_name_to_file_mapper->map($template);
        if (!file_exists($this->template_file)) {
            throw new Exception("Не найден файл $this->template_file для указанного имени шаблона $template");
        }
    }

    protected abstract function substituteContextIntoTemplate():string;

    protected final function execute() {
        $this->findTemplateFile();
        return $this->substituteContextIntoTemplate();
    }
}