<?php
// MySQL database connection settings
$host = 'localhost';
$username = 'capsule';
$password = 'Malinim+59';
$database = 'endoscopy';

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get all table names from the database
$result = mysqli_query($conn, 'SHOW TABLES');
$tables = array();
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Loop through each table and export its data to a CSV file in folder called "exports"
// check if folder exists 
if (!file_exists('exports')) {
    mkdir('exports', 0777, true);
}
foreach ($tables as $table) {
    // Create file name
    $filename = 'exports/' . $table . '.csv';

    // Open file
    $fp = fopen($filename, 'w');

    // Write headers to file
    $headers = array();
    $result = mysqli_query($conn, 'SHOW COLUMNS FROM ' . $table);
    while ($row = mysqli_fetch_assoc($result)) {
        $headers[] = $row['Field'];
    }
    fputcsv($fp, $headers);

    // Get data from table
    $result = mysqli_query($conn, 'SELECT * FROM ' . $table);

    // Loop through data and write to file
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($fp, $row);
    }

    // Close file
    fclose($fp);
}

// Close connection
mysqli_close($conn);

echo "All tables exported successfully!";
?>
