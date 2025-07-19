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

if (isset($_POST['city']) && isset($_POST['hospital'])) {
    $stmt = $conn->prepare("SELECT a.id, a.atype, a.vtype, a.acontact, a.dname, a.dphone 
                            FROM add_ambulance a 
                            JOIN add_hospital h ON a.hname = h.hname 
                            WHERE h.hcity = ? AND h.hname = ?");
    $stmt->bind_param("ss", $_POST['city'], $_POST['hospital']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>
                <tr>
                    <th>Ambulance Type</th>
                    <th>Vehicle Type</th>
                    <th>Contact</th>
                    <th>Driver Name</th>
                    <th>Driver Phone</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            $id = htmlspecialchars($row['id']);
            echo "<tr>
                    <td>" . htmlspecialchars($row['atype']) . "</td>
                    <td>" . htmlspecialchars($row['vtype']) . "</td>
                    <td>" . htmlspecialchars($row['acontact']) . "</td>
                    <td>" . htmlspecialchars($row['dname']) . "</td>
                    <td>" . htmlspecialchars($row['dphone']) . "</td>
                    <td>
                        <form action='book.php' method='POST'>
                            <input type='hidden' name='ambulance_id' value='$id'>
                            <button type='submit' class='btn btn-primary btn-sm'>Book Now</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='alert alert-warning'>No ambulances found for the selected hospital.</div>";
    }
    $stmt->close();
}

$conn->close();
?>
