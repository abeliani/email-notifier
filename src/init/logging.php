<?php declare(strict_types=1);

require_once 'src/file_system/create.php';

function init_log_dir(string $path): void
{
    if (!create_directory($path)) {
        die('cannot create dir: ' . $path . PHP_EOL);
    }
}
