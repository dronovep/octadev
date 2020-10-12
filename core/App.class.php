<?php
/**
 * Главный класс - приложение
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 8:08
 */

class App {

    private $context = [
        'techname' => 'Gulp'
    ];

    public function run() {

        $templater = new ObTemplater([]);
        $templater->template_filename = Constants::COMPONENTS_PATH . 'MainPage/' . 'markup.php';
        $templater->context = $this->context;
        $templater->vaka = 'sdwef';
        echo $templater->vaka;
        echo $templater->render();

//        echo (new ObTemplater([
//            'context' => $this->context,
//            'template_filename' => Constants::COMPONENTS_PATH . 'MainPage/' . 'markup.php'
//        ]))->render();

    }
}

//        echo (new ObTemplater([
//            'context' => $this->context,
//            'template_filename' => Constants::COMPONENTS_PATH . 'MainPage/' . 'markup.php'
//        ]))->render();