<?php
/**
 * Класс отвечающий за бэкенд кнопки
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 18:04
 */

class Button {
    /** @var string файл DOM разметки кнопки */
    private $template;

    /** @var string название класса стилей */
    private $class;

    /** @var string Имя кнопки, которое будет отображаться */
    private $label;

    public function __construct(string $template, string $class, string $label) {

        $this->template = $template;
        $this->class = $class;
        $this->label = $label;
    }

    public function __toString() {

        $file_template_dto = new FileTemplateDTO();
            $file_template_dto->context = [
                'class' => $this->class,
                'label' => $this->label
            ];
            $file_template_dto->template_name = $this->template;

        return (new FileTemplateHtmlRenderer())->call($file_template_dto);
    }
}