<?php
/**
 * Отрисовщик html кода gui элементов по принципу php файлов разметки и вызовов ob_start, ob_get_clean
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 18:54
 */

class ObTemplater extends Functional implements Renderer {

    const SIGNATURE = [
        'context' => 'array',
        'template' => 'string'
    ];

    public function render(): string {
        return $this->call();
    }

    protected function execute() {

        $template_file = (new TemplateNameToFileMapper())->map($this->template);
        if (!file_exists($template_file)) {
            throw new Exception("Не найден файл для указанного имени шаблона");
        }

        extract($this->context);
        ob_start();
        include $template_file;

        return ob_get_clean();
    }
}