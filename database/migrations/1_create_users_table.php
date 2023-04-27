<?php declare(strict_types=1);

return function (PDO $pdo): int {
    $sql = 'CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                validts TIMESTAMP DEFAULT NULL,
                confirmed BOOLEAN NOT NULL DEFAULT false
            )';

    return (int) $pdo->exec($sql);
};