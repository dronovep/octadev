<?php
/**
 * Класс отвечающий за бэкенд кнопки
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 18:04
 */

class Button {
    /** @var string файл DOM разметки кнопки */
    private $markup;

    /** @var string название класса стилей */
    private $css_class;

    /** @var string Имя кнопки, которое будет отображаться */
    private $name;

    public function __construct(string $markup, string $css_class, string $name) {
        if (!file_exists($markup)) {
            throw new Exception('Указанного файла верстки для кнопки не существует');
        }
        $this->markup = $markup;
        $this->css_class = $css_class;
        $this->name = $name;
    }

    public function __toString() {

        return (new ObTemplater([
            'context' => [
                'css_class' => $this->css_class,
                'name' => $this->name
            ],
            'template_filename' => $this->markup
        ]))->render();
    }
}