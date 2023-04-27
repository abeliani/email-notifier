<?php declare(strict_types=1);

return function (PDO $pdo): int {
    $pdo->exec('CREATE UNIQUE INDEX idx_users_username ON users (username)');
    $pdo->exec('CREATE INDEX idx_users_confirmed ON users (confirmed)');

    return $pdo->exec('CREATE INDEX idx_users_validts ON users (validts)');
};