<?php
/**
 * Подстановщик значений в соответствующие места текста из файла php путем использования метода Ob
 * User: Евгений Дронов
 * Date: 14.10.2020
 * Time: 11:00
 */

class ObFileTemplateContextSubstitutor implements Substitutor {

    public function substitute(array $context, string $template): string {

        extract($context);
        ob_start();
        include $template;

        return ob_get_clean();
    }
}