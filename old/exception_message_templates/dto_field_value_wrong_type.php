<?php
/**
 * Ошибка неверного типа переданного значения для поля DTO
 * User: Евгений Дронов
 * Date: 21.10.2020
 * Time: 17:57
 *
 * @var string $property_name  - имя поля DTO
 * @var string $type_name      - имя типа переданного знаения для поля DTO
 * @var string $property_value - переданное значение для поля DTO
 */
?>
Поле <?= $property_name ?> должно быть типа <?= $type_name ?>, а по факту имеет значение <?php var_dump($property_value) ?>
