<?php declare(strict_types=1);

function connect_to_db(string $dsn, string $user, string $pswd): PDO
{
    $connection = new PDO($dsn, $user, $pswd);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
}
