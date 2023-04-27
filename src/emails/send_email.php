<?php declare(strict_types=1);

function send_email(string $email, string $from, string $to, string $subj, string $body): bool
{
    sleep(rand(1, 10));
    return (bool) rand(0,1);
}
