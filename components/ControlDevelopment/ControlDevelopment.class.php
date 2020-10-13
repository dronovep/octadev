<?php
/**
 * Класс управления страницей разработки контрола
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 13:33
 */

class ControlDevelopment {

    /** @var Object объект контрола, который мы разрабатываем */
    private $context = [
        'control' => null
    ];

    private $template = 'control_development';

    public function __construct(Object $control) {

        $this->context['control'] = $control;
    }

    public function __toString() {

        return (new ObTemplater([
            'context' => $this->context,
            'template' => $this->template
        ]))->call();
    }
}

