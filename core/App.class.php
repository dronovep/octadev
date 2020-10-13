<?php
/**
 * Главный класс - приложение
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 8:08
 */

class App {

    public function run() {

        $control = new Button('button', 'mbutton', 'Кнопка');
        echo new ControlDevelopment($control);
    }
}
