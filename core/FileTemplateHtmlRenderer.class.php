<?php
/**
 * Отрисовщик html по шаблону, заданному в специальном файле
 * User: Евгений Дронов
 * Date: 20.10.2020
 * Time: 17:07
 */

class FileTemplateHtmlRenderer extends Functional {

    protected static $dto_type = 'FileTemplateDTO';

    protected final function findTemplateFile(DTO $dto): string {

        $template_filename = (new PhpViewTemplateNameToFileMapper())->map($dto->template_name);
        if (!file_exists($template_filename)) {

            $exception_generator = StandartExceptionGenerator::getSingleton();
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