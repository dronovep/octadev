<?php


interface NameToFileMapper {

    public function map(string $template_name): string;
}