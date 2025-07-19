<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ambulance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['city'])) {
    $city = $conn->real_escape_string($_POST['city']);
    $query = "SELECT hname FROM `add_hospital` WHERE hcity = '$city'";
    $result = $conn->query($query);
    
    echo "<option value=''>Select Hospital</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['hname'] . "'>" . $row['hname'] . "</option>";
    }
}

$conn->close();
?>
