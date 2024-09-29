<?php

function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("The .env file does not exist.");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split key and value
        list($name, $value) = explode('=', $line, 2);

        // Remove any surrounding quotes or whitespace
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        // Set the environment variable
        putenv("$name=$value");
    }
}

// Load the .env file
loadEnv('.env');

?>