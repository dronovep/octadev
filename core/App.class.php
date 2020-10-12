<?php
/**
 * Главный класс - приложение
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 8:08
 */

class App {

    private $context = [
        'techname' => 'Gulp',
        'markup' => Constants::COMPONENTS_PATH . 'Button/markup.php',
        'class' => 'mbutton',
        'name' => 'Кнопка'
    ];

    public function run() {

        $templater = new ObTemplater([]);
            $templater->template_filename = Constants::COMPONENTS_PATH . 'MainPage/' . 'markup.php';
            $templater->context = $this->context;

        echo $templater->render();
    }
}
