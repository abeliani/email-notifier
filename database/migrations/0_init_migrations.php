<?php declare(strict_types=1);

return function (PDO $pdo): int
{
    $sql = 'CREATE TABLE IF NOT EXISTS migrations (
                name VARCHAR(150) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            )';

    return (int) $pdo->exec($sql);
};
