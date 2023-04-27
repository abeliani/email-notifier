<?php declare(strict_types=1);

return function (PDO $pdo): int {
    $sql = 'CREATE TABLE IF NOT EXISTS emails (
                id SERIAL PRIMARY KEY,
                user_id INTEGER NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL,
                checked BOOLEAN NOT NULL DEFAULT false,
                valid BOOLEAN NOT NULL DEFAULT false
            )';

    $pdo->exec($sql);

    return (int) $pdo->exec($sql);
};
