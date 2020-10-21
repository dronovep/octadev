<?php
/**
 * Базис строго типизированного пакета данных для передачи
 * User: Евгений Дронов
 * Date: 20.10.2020
 * Time: 12:33
 */

abstract class DTO {

    const SIGNATURE = [];

    private $unset_properties;

    public final function __construct() {

        foreach (static::SIGNATURE AS $name => $type) {
            $this->unset_properties[$name] = null;
        }
    }

    protected final function typeNameRefersToElementaryType($type_name): bool {

        return in_array($type_name, Constants::PHP_ELEMENTARY_TYPES);
    }

    protected final function checkValueIsOfElementaryType($type_name, $property_name, $property_value) {

            $check_type_func = "is_$type_name";
            if (!$check_type_func($property_value)) {

                $exception_generator = StandartExceptionGenerator::getSingleton();
                $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                    [
                        'property_name'  => $property_name,
                        'type_name'      => $type_name,
                        'property_value' => $property_value
                    ],
                    'dto_field_value_wrong_type'
                );
            }
    }

    protected final function checkClassExistense($class_name, $property_name) {

        try {
                class_exists($class_name);
            } catch (Exception $e) {

                $exception_generator = StandartExceptionGenerator::getSingleton();
                $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                    [
                        'property_name' => $property_name,
                        'class_name'    => $class_name
                    ],
                    "dto_invalid_signature"
                );
            }
    }

    protected final function checkValueIsInstanceOfClass($property_value, $class_name, $property_name) {
            if (!($property_value instanceof $class_name)) {

                $exception_generator = StandartExceptionGenerator::getSingleton();
                $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                    [
                        'property_name'  => $property_name,
                        'type_name'      => $class_name,
                        'property_value' => $property_value
                    ],
                    'dto_field_value_wrong_type'
                );
            }
    }

    protected final function checkPropertyValueHasCorrectType(string $property_name, $property_value) {

        $required_type_name = static::SIGNATURE[$property_name];
        if ($this->typeNameRefersToElementaryType($required_type_name)) {

            $this->checkValueIsOfElementaryType($required_type_name, $property_name, $property_value);
        } else {
            $this->checkClassExistense($required_type_name, $property_name);
            $this->checkValueIsInstanceOfClass($property_value, $required_type_name, $property_name);
        }
    }

    public final function __get(string $property_name) {
        return $this->$property_name ?: null;
    }

    public final function __set(string $property_name, $property_value) {
        if (key_exists($property_name, static::SIGNATURE)) {
            $this->checkPropertyValueHasCorrectType($property_name, $property_value);
        }
        $this->$property_name = $property_value;
        if (key_exists($property_name, $this->unset_properties)) {
            unset($this->unset_properties[$property_name]);
        }
    }

    public final function validate() {

         if (!empty($this->unset_properties)) {

             $exception_generator = StandartExceptionGenerator::getSingleton();
             $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                 ['unset_properties' => $this->unset_properties],
                 'dto_not_filled'
             );
        }
    }
}