<?php declare(strict_types=1);

return function (PDO $pdo): int {
    return $pdo->exec('CREATE INDEX idx_emails_user_id ON emails (user_id)');
};
