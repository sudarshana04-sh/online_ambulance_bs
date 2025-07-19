<?php
$display="";
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ambulance";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ambulance_id = intval($_POST['ambulance_id']);
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $user_address = $conn->real_escape_string($_POST['user_address']);
    $user_city = $conn->real_escape_string($_POST['user_city']);
    $user_phone = $conn->real_escape_string($_POST['user_phone']);
    $user_email = $conn->real_escape_string($_POST['user_email']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $booking_time = $conn->real_escape_string($_POST['booking_time']);
    $notes = $conn->real_escape_string($_POST['notes']);

    $stmt = $conn->prepare("INSERT INTO `bookings` (ambulance_id, user_name, user_address, user_city, user_phone, user_email, booking_date, booking_time, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("issssssss", $ambulance_id, $user_name, $user_address, $user_city, $user_phone, $user_email, $booking_date, $booking_time, $notes);

    if ($stmt->execute()) {
       $display='<div class="alert alert-success">Ambulance Booked Successfully</div>';  
    } else {
        $display='<div class="alert alert-success">Booking Failed</div>';  
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Begin HTML -->
<?php include 'header.php'; ?>

<div class="container my-5">
    <?php if (isset($success)): ?>
        <div class="alert alert-success shadow">
            <h4 class="alert-heading">Booking Confirmed!</h4>
            <p>Thank you, <strong><?= htmlspecialchars($user_name) ?></strong>!<br>
            Your ambulance has been booked for <strong><?= htmlspecialchars($booking_date) ?></strong> at <strong><?= htmlspecialchars($booking_time) ?></strong>.</p>
            <hr>
            <p><strong>Confirmation sent to:</strong> <?= htmlspecialchars($user_email) ?></p>
            <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
        </div>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger shadow">
            <h4 class="alert-heading">Oops!</h4>
            <p><?= $error ?></p>
            <a href="javascript:history.back()" class="btn btn-secondary mt-3">Go Back</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
