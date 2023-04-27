<?php declare(strict_types=1);

function set_email_valid(array &$email, bool $valid)
{
    $email['valid'] = $valid;
    $email['checked'] = true;
}
