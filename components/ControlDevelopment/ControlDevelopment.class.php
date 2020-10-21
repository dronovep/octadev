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

        $file_template_dto = new FileTemplateDTO();
            $file_template_dto->context = $this->context;
            $file_template_dto->template_name = $this->template;

        return (new FileTemplateHtmlRenderer())->call($file_template_dto);
    }
}

