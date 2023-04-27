<?php declare(strict_types=1);

require_once 'bootstrap.php';
$config = require_once 'config/config.php';

require_once SRC_DIR . DS . 'logging/file_log.php';
require_once SRC_DIR . DS . 'templates/file_template.php';
require_once SRC_DIR . DS . 'users/db_users.php';
require_once SRC_DIR . DS . 'emails/db_email.php';
require_once SRC_DIR . DS . 'emails/send_email.php';
require_once 'database/db.php';

$db = $config['db'];
$mailing = $config['mailing'];
$connection = connect_to_db($db['dsn'], $db['user'], $db['password']);

foreach (get_users_with_expiring_subscriptions($connection, $mailing['interval'], $mailing['batch']) as $user) {
    if (db_is_email_valid($connection, $user['email'])) {
        $notified = send_email(
            $user['email'],
            $config['mailing']['address_from'],
            $user['email'],
            $config['mailing']['email_header'],
            set_variable_to_template(get_expiration_template_by_lang('en'), $user['username'])
        );

        if (!$notified) {
            file_add_info($config['log']['path'], 'File to user notify', $user);
            continue;
        }

        update_users_notify_sent($connection, $user['id']);
        file_add_info($config['log']['path'], 'User successful notified', $user);
    }
}
