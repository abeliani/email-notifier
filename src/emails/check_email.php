<?php declare(strict_types=1);

function check_email_domain(string $email): bool
{
    return getmxrr(
        substr(
            strrchr($email, "@"), 1),
        $mxhosts
    );
}

function check_email_syntax(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    foreach (['/', ',', '\\', ';', ':', '|', '(', ')', '[', ']', '{', '}', '`', ' '] as $char) {
        if (strpos($email, $char) !== false) {
            return false;
        }
    }

    return true;
}

function check_email_service(array $config, string $email): bool
{
    sleep(rand(1, 60));
    return (bool) rand(0, 1);
}