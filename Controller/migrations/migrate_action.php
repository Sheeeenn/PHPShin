<?php
require_once('migrate_process.php');

// Ensure $Migrates is defined
$newMigrateValues = [];
$checker = [];

// Define the path to your PHP file
$filePath = 'Controller/migrations/migrate.php';
$filePath2 = 'Controller/migrations/migrate_process.php';
$fileContent = file_get_contents($filePath);

// Collect existing migrations
// Use regular expressions to find the contents of the $Migrates array
preg_match('/\$Migrates\s*=\s*\[(.*?)\];/s', $fileContent, $matches);

// Check if matches were found
if (isset($matches[1])) {
    // Get the contents inside the brackets
    $migrateContents = $matches[1];

    // Split the contents by comma and trim whitespace
    $migratesArray = array_map('trim', explode(',', $migrateContents));

    // Store the values in the new array
    foreach ($migratesArray as $migration) {

        if (!empty(trim($migration))) { // Check if the migration is not empty after trimming whitespace
            $checker[] = $migration; // Add to the checker array if not empty
            $newMigrateValues[] = $migration; // Add to the new array if not empty
        }
    }
} else {
    echo "No migrations found.";
}

// Ensure $List is defined and add new migrations if they do not already exist
if (isset($List) && is_array($List)) {
    foreach ($List as $migrants) {
        $migrationWithParentheses = $migrants . "()"; // Add parentheses to each migration
        
        // Check if the migration already exists in the $newMigrateValues array
        if (!in_array($migrationWithParentheses, $newMigrateValues)) {
            $newMigrateValues[] = $migrationWithParentheses; // Add only if it does not exist
        }
    }
}

// Read the file into an array of lines
$lines = file($filePath, FILE_IGNORE_NEW_LINES);

// Find the line containing the $Migrates array
foreach ($lines as $index => $line) {
    if (strpos($line, '$Migrates =') !== false) {
        // Check if there are migrations to include
        if ($newMigrateValues > 0 ) {
            // Update the line with the new migrate values
            $lines[$index] = '$Migrates = [' . implode(", ", $newMigrateValues) . '];';
        } else {
            // If there are no migrations, set it to an empty array
            $lines[$index] = '$Migrates = [];'; // Ensure it's empty
        }
        break; // Exit the loop once the line is found and updated
    }
}

// Write the modified lines back to the file
file_put_contents($filePath, implode(PHP_EOL, $lines));
file_put_contents($filePath2, "<?php \n\$List = [];"); // Clear the migrate_process.php
?>
