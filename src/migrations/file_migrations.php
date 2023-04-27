<?php declare(strict_types=1);

function get_migration_files(): array
{
    $migration_files = glob(MIGRATIONS_DIR . DS . '[0-9]*.php',  GLOB_ERR | GLOB_NOSORT);
    natsort($migration_files);

    return $migration_files;
}

function filter_committed_migration(array &$migration_files, array $history): void
{
    foreach ($migration_files as $idx => $file) {
        if (in_array(pathinfo($file, PATHINFO_FILENAME), $history)) {
            unset($migration_files[$idx]);
        }
    }
}
