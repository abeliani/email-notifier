<?php declare(strict_types=1);

require_once 'src/migrations/db_migrations.php';
require_once 'src/migrations/file_migrations.php';

function init_migrations(PDO $conn): void
{
    $migrations = get_migration_files();
    filter_committed_migration($migrations, get_migrations_history($conn));
    commit_migrations($migrations, $conn);
}
