<?php declare(strict_types=1);

return function (PDO $pdo): int {
    $sql = 'ALTER TABLE users
            ADD COLUMN processing_at TIMESTAMP DEFAULT NULL,
            ADD COLUMN sent_at TIMESTAMP DEFAULT NULL';

    $pdo->exec($sql);

    return $pdo->exec('CREATE INDEX idx_users_need_notify ON users (need_notify)');
};
