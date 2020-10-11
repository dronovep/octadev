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
        $main_page_view_file = Constants::COMPONENTS_PATH . 'MainPage/' . 'View.php';

        extract($this->context);

        ob_start();
        include $main_page_view_file;
        $html = ob_get_clean();

        echo $html;
    }
}