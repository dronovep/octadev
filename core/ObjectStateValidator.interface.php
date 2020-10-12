<?php
/**
 * Интерфейс валидатора объектов. Валидатор призван проверить состояние объекта,
 * перед его использованием по главному назначению
 * User: Евгений Дронов
 * Date: 12.09.2020
 * Time: 20:35
 */

interface ObjectStateValidator {
    public function validate(Object $object): void;
}