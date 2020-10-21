<?php
/**
 * DTO для шаблонизатора, использующего файл шаблона
 * User: Евгений Дронов
 * Date: 13.10.2020
 * Time: 14:53
 */

class FileTemplateDTO extends DTO {

    const SIGNATURE = [
        'context' => 'array',
        'template_name' => 'string'
    ];
}