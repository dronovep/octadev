<?php
/**
 * Генератор исключений с заданным контекстом и выбранным шаблоном сообщения об ошибке.
 * Контекст содержит значения переменных, используемых в шаблоне
 * User: Евгений Дронов
 * Date: 21.10.2020
 * Time: 8:51
 */

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