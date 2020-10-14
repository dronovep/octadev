<?php
/**
 * Интерфейс подстановщика значений в шаблон
 * User: Евгений Дронов
 * Date: 14.09.2020
 * Time: 9:46
 */

interface Substitutor {
    public function substitute(array $values, string $template): string;
}