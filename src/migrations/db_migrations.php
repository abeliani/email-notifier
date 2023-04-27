<?php declare(strict_types=1);

function commit_migrations(array $migrations, PDO $conn): void
{
    foreach ($migrations as $file) {
        $migration_function = include $file;
        if (!is_callable($migration_function)) {
            die($file . ' must return callable function' . PHP_EOL);
        }
        if ($migration_function($conn) === false) {
            die($file . ' error during commit the migrate'.  PHP_EOL);
        }

        _add_migrate_to_history($file, $conn);
    }
}

function get_migrations_history(PDO $conn): array
{
    try {
        return array_column(_get_migration_history($conn), 'name');
    } catch (PDOException $e) {
        return [];
    }
}

function _get_migration_history(PDO $conn): array
{
    $stmt = $conn->query('SELECT * FROM migrations');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function _add_migrate_to_history(string $path, PDO $conn): bool
{
    $filename_without_extension = pathinfo($path, PATHINFO_FILENAME);
    $stmt = $conn->prepare('INSERT INTO migrations VALUES (:name)');
    $stmt->bindParam(':name', $filename_without_extension);

    return $stmt->execute();
}