<?php declare(strict_types=1);

!version_compare(phpversion(), '7.4.0', '<') or die('Minimum php7.4 is required');

require_once 'bootstrap.php';
require_once 'src/init/logging.php';
require_once 'src/init/migrations.php';

$config = require_once 'config/config.php';
$db = require_once 'database/db.php';

$db = $config['db'];
$connection = connect_to_db($db['dsn'], $db['user'], $db['password']);

init_log_dir($config['log']['path']);
init_migrations($connection);