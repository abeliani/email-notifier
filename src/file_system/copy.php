<?php declare(strict_types=1);

function copy_file(string $source_file, string $destination_file): bool {
    if (!file_exists($source_file)) {
        die("Source file '{$source_file}' does not exist");
    }

    return copy($source_file, $destination_file);
}

