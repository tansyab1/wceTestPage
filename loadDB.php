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

// show data table `4`, `5`, `6`, `8`, `12`, `27`, `28`, `32`, `33`, `34`, `35`, `36`, `38` 

// show each table data

$query = "SELECT * FROM `4`";
echo 'Table: 4<br>';

// execute the query
$result = mysqli_query($conn, $query);

// loop through the results
while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `5`";
echo 'Table: 5<br>';

// execute the query
$result = mysqli_query($conn, $query);

// loop through the results
while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `6`";
echo 'Table: 6<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results
while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `8`";
echo 'Table: 8<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results
while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `12`";

echo 'Table: 12<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results
while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `27`";

echo 'Table: 27<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `28`";

echo 'Table: 28<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `32`";

echo 'Table: 32<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `33`";

echo 'Table: 33<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';
}

$query = "SELECT * FROM `34`";

echo 'Table: 34<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns
    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';

}

$query = "SELECT * FROM `35`";

echo 'Table: 35<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns

    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';

}

$query = "SELECT * FROM `36`";

echo 'Table: 36<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns

    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';

}

$query = "SELECT * FROM `38`";

echo 'Table: 38<br>';

// execute the query

$result = mysqli_query($conn, $query);

// loop through the results

while ($row = mysqli_fetch_array($result)) {
    // show the results of all columns

    echo $row['videoName'] . ' ' . $row['value'] . ' ' . $row['timeProcess'] . '<br>';

}




// Close connection
mysqli_close($conn);

echo "All tables exported sussfully!";
?>
