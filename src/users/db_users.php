<?php declare(strict_types=1);

function get_users_with_expiring_subscriptions(PDO $conn, string $interval, int $limit): Generator
{
    $conn->beginTransaction();

    $stmt = $conn->prepare("
            SELECT *
            FROM users
            WHERE processing_at IS NULL AND confirmed = true
            AND validts::date BETWEEN (NOW())::date AND (NOW() + INTERVAL '{$interval}')::date
            ORDER BY id
            FOR UPDATE SKIP LOCKED
            LIMIT :limit
        ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $conn->prepare('UPDATE users SET processing_at = NOW() WHERE id = :id')->execute(['id' => $user['id']]);
        yield $user;
    }

    $conn->commit();
}

function update_users_notify_sent(PDO $conn, int $user_id): bool
{
    return $conn
        ->prepare('UPDATE users SET sent_at = NOW() WHERE id = :id')
        ->execute(['id' => $user_id]);
}
