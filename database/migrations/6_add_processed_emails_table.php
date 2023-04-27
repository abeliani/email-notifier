<?php declare(strict_types=1);

return function (PDO $pdo): int {
    $sql = 'ALTER TABLE emails
            ADD COLUMN processing_at TIMESTAMP DEFAULT NULL';

    $pdo->exec($sql);

    return $pdo->exec('CREATE INDEX idx_emails_processing_at ON emails (processing_at)');
};
