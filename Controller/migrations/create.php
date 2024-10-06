<?php

if ($argc < 3 || $argv[1] != 'table') {
    echo "Usage: php create.php table table_name\n";
    exit(1);
}

$tableName = $argv[2];
$timestamp = date('Y_m_d_His');
$fileName = "Model/{$timestamp}_create_{$tableName}_table.php";


$fileContent = "<?php\n\nrequire_once(\"Controller/database/table.php\");
require_once(\"Controller/migrations/migrate.php\");\n\n/*\n\tThis file allows you to create and customize your tables.\n\tOnce you have created a table, ensure that you migrate it in the Terminal \"composer migrate\".\n*/\n\nfunction {$tableName}() {\n\n\tcreateTable::id(); //This code is required for every table that you'll create.\n\n}\n\n// Migration for table '{$tableName}'\n\n";

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

///////////////////////////////////////// ADD REQUIRE /////////////////////////////////////////////////////

// Specify the file you want to modify
$targetFile = 'Controller/migrations/migrate.php'; // Adjust the path as necessary

// Read the current content of the target file
$currentContent = file($targetFile);

// Specify the line to add (in this case, we're inserting after the first line)
$lineToAdd = "require('{$fileName}');\n"; // The new line to insert
$lineNumber = 1; // The line number where you want to add the new line (0-based index)

// Insert the new line at the specified position
array_splice($currentContent, $lineNumber, 0, $lineToAdd);

// Write the modified content back to the file
file_put_contents($targetFile, implode("", $currentContent));

// Optionally, you can output a message
echo "Line added to $targetFile";


?>