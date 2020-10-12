<?php
/**
 * Функционал - заклассованая функция. По сути классовая обертка для функции.
 * Вместо использования обычных функций с учетом их сигнатур,
 * теперь сигнатура функции записана в поля объекта, имя класса олицетворяет  имя функции,
 * а вызов функции делается через метод call
 * User: Евгений Дронов
 * Date: 11.10.2020
 * Time: 22:37
 */

abstract class Functional {

    const SIGNATURE = [];

    private $unset_properties;

    public final function __construct(array $args) {

        $this->unset_properties = [];
        foreach (static::SIGNATURE AS $name => $type) {
            $this->unset_properties[$name] = null;
        }

        foreach ($args as $name => $value ) {
            $this->__set($name, $value);
        }
    }

    protected final function checkPropertyType(string $property_name, $property_value) {

        $required_type = static::SIGNATURE[$property_name];
        if (in_array($required_type, Constants::PHP_ELEMENTARY_TYPES)) {

            $check_type_func = "is_$required_type";
            if (!$check_type_func($property_value)) {
                throw new Exception(
                    "Поле $property_name должно быть типа $required_type, а по факту имеет значение " .
                    var_export($property_value, true)
                );
            }
        } else {

//                $property_class = new ReflectionClass($required_type);
            try {
                class_exists($required_type);
            } catch (Exception $e) {
                throw new Exception(
                    "Неправильно составлена сигнатура функционала: полю $property_name указан несуществующий тип $required_type"
                );
            }

            if (!($property_value instanceof $required_type)) {
                throw new Exception(
                    "Поле $property_name должно быть типа $required_type, а по факту имеет значение " .
                    var_export($property_value, true)
                );
            }
        }
    }



    public final function __get($property_name) {
        return $this->$property_name ?: null;
    }
    
    public final function __set($property_name, $property_value) {
        if (key_exists($property_name, static::SIGNATURE)) {
            $this->checkPropertyType($property_name, $property_value);
        }
        $this->$property_name = $property_value;
        if (key_exists($property_name, $this->unset_properties)) {
            unset($this->unset_properties[$property_name]);
        }
    }

    protected abstract function execute();

    public function call() {
        if (!empty($this->unset_properties)) {
            throw new Exception(
                "В данный момент еще нельзя использовать функционал, так как пока отсутствуют поля " .
                var_export($this->unset_properties, true)
            );
        }
        return $this->execute();
    }
}