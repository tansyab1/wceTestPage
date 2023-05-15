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

// if connection is successful, then export all tables
// if (mysqli_ping($conn)) {
//     echo 'Connection OK' . mysqli_stat($conn);
// } else {
//     echo 'Error: ' . mysqli_error($conn);
// }

// Get all table names from the database
$result = mysqli_query($conn, 'SHOW TABLES');
$tables = array();
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// // show all tables names
// echo "<pre>";
// print_r($tables);
// echo "</pre>";

// Loop through each table and export its data to a CSV file in folder called "exports"
// check if folder exists in current directory, if not create it

// if (!is_dir('exports')) {
//     mkdir('exports');
//     echo "Folder does not exist, creating folder...";
// }

// // show the notification message if folder was created
// if (is_dir('exports')) {
//     echo "Folder created successfully!";
// }

foreach ($tables as $table) {
    // save table to test.csv file in exports folder
    $filename = 'exports/' . 'test.csv';
    $fp = fopen($filename, 'w');
    // check if file exists
    if (file_exists($filename)) {
        echo "File exists, writing to file...";
    }
    // check if file is writable
    if (is_writable($filename)) {
        echo "File is writable...";
    }
    // write the table headers to the file
    $header = mysqli_query($conn, "SHOW COLUMNS FROM " . $table);
    while ($row = mysqli_fetch_row($header)) {
        $header_row[] = $row[0];
    }
    fputcsv($fp, $header_row);
    // write all the data to the file
    $data = mysqli_query($conn, "SELECT * FROM " . $table);
    while ($row = mysqli_fetch_row($data)) {
        fputcsv($fp, $row);
    }
    // close the file
    fclose($fp);
}

// Close connection
mysqli_close($conn);

echo "All tables exported successfully!";
?>
