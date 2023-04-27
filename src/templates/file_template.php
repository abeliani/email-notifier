<?php declare(strict_types=1);

function get_expiration_template_by_lang(string $lang): string
{
    $tmpls = include dirname(__DIR__, 2) . '/templates/translations.php';

    return $tmpls[$lang] ?? '';
}

function set_variable_to_template(string $tmpl, string $username): string
{
   return str_replace('{username}', $username, $tmpl);
}