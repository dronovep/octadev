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
        'template_filename' => 'string'
    ];

    public function render(): string {
        return $this->call();
    }

    protected function execute() {

        extract($this->context);

        ob_start();
        include $this->template_filename;

        return ob_get_clean();
    }
}