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

    private $renderer;

    public function __construct(string $markup, string $css_class) {
        if (!file_exists($markup)) {
            throw new Exception('Указанного файла верстки для кнопки не существует');
        }
        $this->markup = $markup;
        $this->css_class = $css_class;
    }

    public function __toString() {


        ob_start();
        include $this->markup;

        return ob_get_clean();
    }
}