<?php

if ($argc < 3 || $argv[1] != 'table') {
    echo "Usage: php create.php table table_name\n";
    exit(1);
}

$tableName = $argv[2];
$timestamp = date('Y_m_d_His');
$fileName = "Model/{$timestamp}_create_{$tableName}_table.php";


$fileContent = "<?php\n\n// Migration for table '{$tableName}'\n\n";

if (!file_exists('Model')) {
    mkdir('Model', 0777, true);
}

file_put_contents($fileName, $fileContent);

echo "Migration file created: {$fileName}\n";



// Load the existing migrations
require_once("migrate_process.php");

// Check if $List is an array
if (is_array($List)) {
    $New = $List;
    $New [] = $tableName;
    $test = implode("\", \"", $New);
    $fileContent2 = "<?php \n\$List = [\"$test\"];";
    file_put_contents("Controller/migrations/migrate_process.php", $fileContent2);

} else {
    echo "Error: \$List is not an array.";
}


?>