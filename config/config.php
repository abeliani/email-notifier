<?php declare(strict_types=1);

return $config = [
    'app' => [
      'lang' => 'en',
    ],
    'db' => [
        'user' => 'postgres',
        'password' => 'postgres',
        'dsn' => 'pgsql:host=db;dbname=subscription',
    ],
    'email' => [
        'validate_enabled' => true,
        'AuthUser' => 'qwerty123',
        'AuthHeader' => 'Bearer qwerty123',
    ],
    'mailing' => [
        'address_from' => 'noreply@example.com',
        'email_header' => 'Subscription expiration notice',
        'interval' => '3 days',
        'batch' => 1000,
    ],
    'log' => [
        'path' => '../logs',
    ],
];
