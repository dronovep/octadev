<?php
/**
 * Отрисовщик html кода gui элементов по принципу php файлов разметки и вызовов ob_start, ob_get_clean
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 18:54
 */

class ObFileTemplateDTO extends FileTemplateDTO {

    protected function predecorateConstructor(array& $args) {

        $args['template_name_to_file_mapper'] = new PhpViewTemplateNameToFileMapper();
        $args['context_substitutor'] = new ObFileTemplateContextSubstitutor();
    }
}