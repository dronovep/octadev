<?php
/**
 * Интерфейс отрисовчика HTML кода gui элементов
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 18:48
 */

interface Renderer {
    public function render(): string;
}