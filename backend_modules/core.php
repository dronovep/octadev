<?php
/**
 * core.php
 * User: Евгений Дронов
 * Date: 22.10.2020
 * Time: 13:19
 */

class Environment {

    /* @var Environment - синглтон данного класса */
    private static $environment;

    /* @var string КОрневая папака проекта на сервере */
    private $project_dir;

    private function getProjectDir() {

        if (empty($this->project_dir)) {
            $this->project_dir = $_SERVER['MPROJECT_DIR'];
        }

        return $this->project_dir;
    }

    public static function ProjectDir() {

        if (empty(self::$environment)) {
            self::$environment = new self();
        }

        return self::$environment->getProjectDir();
    }
};

interface NameToFileMapper {

    public function map(string $template_name): string;
}

class ErrorMessageTemplateNameToFileMapper implements NameToFileMapper {

    public function map(string $template_name): string {
        return Constants::ERROR_MESSAGE_TEMPLATES_PATH . $template_name . '.php';
    }
}

class GenericExceptionGenerator {

    protected $template_name_to_file_mapper;

    public function __construct(NameToFileMapper $template_name_to_file_mapper) {

        $this->template_name_to_file_mapper = $template_name_to_file_mapper;
    }

    protected final function checkTemplateFileExistense($template_filename) {

        if (!file_exists($template_filename)) {
            throw new Exception("Не найден файл шаблона сообщения об ошибке $template_filename");
        }
    }

    public final function generateExceptionUsingContextArrayAndErrorMessageTemplateName
    (
        array $context,
        string $error_message_template_name
    ) {
            $error_message_template_filename = $this->template_name_to_file_mapper->map($error_message_template_name);
            $this->checkTemplateFileExistense($error_message_template_filename);
            extract($context);
            ob_start();
            include $error_message_template_filename;
            $error_message = ob_get_clean();

            throw new Exception($error_message);
    }
}

interface Singleton {

    public static function getSingleton();
}

class StandardExceptionGenerator extends GenericExceptionGenerator implements Singleton {

    private static $singleton;

    public function __construct() {
        parent::__construct(new ErrorMessageTemplateNameToFileMapper());
    }

    public static function getSingleton()
    {
        if (is_null(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }
}

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

                $exception_generator = StandardExceptionGenerator::getSingleton();
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

                $exception_generator = StandardExceptionGenerator::getSingleton();
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

                $exception_generator = StandardExceptionGenerator::getSingleton();
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

             $exception_generator = StandardExceptionGenerator::getSingleton();
             $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                 ['unset_properties' => $this->unset_properties],
                 'dto_not_filled'
             );
        }
    }
}

class FileTemplateDTO extends DTO {

    const SIGNATURE = [
        'context' => 'array',
        'template_name' => 'string'
    ];
}

abstract class Functional {

    protected static $dto_type = '';

    protected final function checkDTOTypeExistense(DTO $dto) {

        try {
            class_exists(static::$dto_type);
        } catch(Exception $e) {
            $exception_generator = StandardExceptionGenerator::getSingleton();
            $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                ['dto_type' => static::$dto_type],
                "dto_type_doesn't_exist"
            );
        }
    }

    protected final function checkDTOCorrespondsItsType(DTO $dto) {

        if (!($dto instanceof static::$dto_type)) {
            $exception_generator = StandardExceptionGenerator::getSingleton();
            $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                ['dto_type' => static::$dto_type],
                "dto_value_wrong_type"
            );
        }
    }

    protected abstract function execute(DTO $dto);

    public function call(DTO $dto) {
        $this->checkDTOTypeExistense($dto);
        $this->checkDTOCorrespondsItsType($dto);
        $dto->validate();
        return $this->execute($dto);
    }
}

class PhpViewTemplateNameToFileMapper implements NameToFileMapper {

    public function map(string $template_name): string {
        return Constants::HTML_TEMPLATES_PATH . $template_name . '.php';
    }
}

class FileTemplateHtmlRenderer extends Functional {

    protected static $dto_type = 'FileTemplateDTO';

    protected final function findTemplateFile(DTO $dto): string {

        $template_filename = (new PhpViewTemplateNameToFileMapper())->map($dto->template_name);
        if (!file_exists($template_filename)) {

            $exception_generator = StandardExceptionGenerator::getSingleton();
            $exception_generator->generateExceptionUsingContextArrayAndErrorMessageTemplateName(
                [
                    'template_filename' => $template_filename,
                    'template_name'     => $dto->template_name
                ],
                "html_file_template_doesn't_exist"
            );
        }

        return $template_filename;
    }

    protected function execute(DTO $dto): string {

        $template_file = $this->findTemplateFile($dto);
        extract($dto->context);
        ob_start();
        include $template_file;

        return ob_get_clean();
    }
}

class EntrancePoint {

    public function runApplication() {

        $control = new Button('button', 'mbutton', 'Кнопка');
        echo new ControlDevelopment($control);
    }
}




