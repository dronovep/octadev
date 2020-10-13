<?php
/**
 * Отрисовщик html кода gui элементов по принципу php файлов разметки и вызовов ob_start, ob_get_clean
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 18:54
 */

class ObTemplater extends Templater{

    protected function predecorateConstructor(array& $args) {

        $args['template_name_to_file_mapper'] = new PhpViewTemplateNameToFileMapper();
    }

    protected function substituteContextIntoTemplate(): string {

        extract($this->context);
        ob_start();
        include $this->template_file;

        return ob_get_clean();
    }
}