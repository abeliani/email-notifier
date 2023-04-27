<?php declare(strict_types=1);

function create_directory(string $path, int $mode = 0755): bool
{
    return is_dir($path) || mkdir($path, $mode, true);
}
