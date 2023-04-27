<?php declare(strict_types=1);

function db_get_unchecked_emails_processing(PDO $conn): Generator
{
    $conn->beginTransaction();

    $stmt = $conn->prepare('
            SELECT *
            FROM emails
            WHERE checked = false AND processing_at IS NULL
            ORDER BY id
            FOR UPDATE SKIP LOCKED
            LIMIT 1000
        ');
    $stmt->execute();

    while ($email = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $conn->prepare('UPDATE emails SET processing_at = NOW() WHERE id = :id')->execute(['id' => $email['id']]);
        yield $email;
    }

    $conn->commit();
}

function db_update_email_checked(PDO $conn, array $email): bool
{
    $stmt = $conn->prepare('UPDATE emails SET checked=true, valid=:valid WHERE email=:email');
    $stmt->bindValue(':email', $email['email']);
    $stmt->bindValue(':valid', $email['valid'], PDO::PARAM_BOOL);

    return $stmt->execute();
}

function db_is_email_valid(PDO $connection, string $email)
{
    $sql = "SELECT valid FROM emails WHERE email = :email AND checked =true";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':email', $email);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['valid'] : false;
}
