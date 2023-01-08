<?php
// $servername = "localhost";
// $username = "capsule";
// $password = "Malinim+59";

// // Create connection
// $conn = new mysqli($servername, $username, "Malinim+59", "endoscopy");

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// $sql = "SELECT * FROM userNote";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while ($row = $result->fetch_assoc()) {
//         echo "id: " . $row["ID"] . " - Name: " . $row["firstName"] . " " . $row["lastName"] . "<br>";
//     }
// } else {
//     echo "0 results";
// }
// $conn->close();

$sql = "SELECT * FROM userNote";
// $conn = mysqli_connect("wcetest-do-user-13153530-0.b.db.ondigitalocean.com","doadmin","AVNS_8WsUdQ7GU9RwUI5S9gd","DATA", 25060);
$conn = mysqli_connect("localhost", "capsule", "Malinim+59", "endoscopy");

mysqli_query($conn, $sql);

$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

// show the value of the result
echo $num;

// close the connection
mysqli_close($conn);
