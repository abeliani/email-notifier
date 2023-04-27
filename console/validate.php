<?php declare(strict_types=1);

$config = require_once 'config/config.php';
require_once 'database/db.php';
require_once 'src/emails/db_email.php';
require_once 'src/emails/check_email.php';
require_once 'src/emails/edit_email.php';

$connection = connect_to_db($config['db']['dsn'], $config['db']['user'], $config['db']['password']);

foreach (db_get_unchecked_emails_processing($connection) as $email) {
    if (!check_email_syntax($email['email']) || !check_email_domain($email['email'])) {
        set_email_valid($email, false);
        db_update_email_checked($connection, $email);
        continue;
    }
    if ($config['email']['validate_enabled']) {
        set_email_valid($email, check_email_service($config['email'], $email['email']));
        db_update_email_checked($connection, $email);
    }
}
