<?php include('aheader.php'); ?>
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "ambulance");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch counts for summary cards
$hospital_count = $conn->query("SELECT COUNT(*) AS count FROM add_hospital")->fetch_assoc()['count'];
$ambulance_count = $conn->query("SELECT COUNT(*) AS count FROM add_ambulance")->fetch_assoc()['count'];
$booking_count = $conn->query("SELECT COUNT(*) AS count FROM bookings")->fetch_assoc()['count'];

// Fetch recent bookings (limited to 5)
$query = "
    SELECT 
        b.id AS booking_id,
        b.user_name,
        b.user_address,
        b.user_city,
        b.user_phone,
        b.user_email,
        b.booking_date,
        b.booking_time,
        b.notes,
        a.atype,
        a.vtype,
        a.dname,
        h.hname
    FROM bookings b
    LEFT JOIN add_ambulance a ON b.ambulance_id = a.id
    LEFT JOIN add_hospital h ON a.hname = h.hname
    ORDER BY b.booking_date DESC, b.booking_time DESC
    LIMIT 5
";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">AMBULANCE BOOKING DASHBOARD</h1>
                <h1 class="page-subhead-line">Overview of hospitals, ambulances, and bookings</h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-4">
                <div class="main-box mb-red">
                    <a href="add_hospital.php">
                        <i class="fa fa-hospital-o fa-5x"></i>
                        <h5><?php echo htmlspecialchars($hospital_count); ?> Hospitals</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="main-box mb-dull">
                    <a href="add_ambulance.php">
                        <i class="fa fa-ambulance fa-5x"></i>
                        <h5><?php echo htmlspecialchars($ambulance_count); ?> Ambulances</h5>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="main-box mb-pink">
                    <a href="view_bookings.php">
                        <i class="fa fa-calendar fa-5x"></i>
                        <h5><?php echo htmlspecialchars($booking_count); ?> Bookings</h5>
                    </a>
                </div>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Recent Bookings
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>sl no</th>
                                        <th>User Name</th>
                                        <th>City</th>
                                        <th>Ambulance Type</th>
                                        <th>Hospital</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['booking_id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_city']); ?></td>
                                            <td><?php echo htmlspecialchars($row['atype']); ?></td>
                                            <td><?php echo htmlspecialchars($row['hname']); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['booking_date'])); ?></td>
                                            <td><?php echo date("h:i A", strtotime($row['booking_time'])); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i>Notifications
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <?php
                            // Reuse recent bookings for notifications
                            $result->data_seek(0); // Reset result pointer
                            while ($row = $result->fetch_assoc()) {
                                echo '<a href="view_bookings.php" class="list-group-item">';
                                echo '<i class="fa fa-calendar fa-fw"></i>New Booking by ' . htmlspecialchars($row['user_name']);
                                echo '<span class="pull-right text-muted small"><em>' . date("d-m-Y h:i A", strtotime($row['booking_date'] . ' ' . $row['booking_time'])) . '</em></span>';
                                echo '</a>';
                            }
                            ?>
                        </div>
                        <a href="vbooking.php" class="btn btn-info btn-block">View All Bookings</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<div id="footer-sec">
    © 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
</div>
<!-- /. FOOTER  -->
<!-- SCRIPTS -AT THE BOTTOM TO REDUCE THE LOAD TIME-->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>
<?php $conn->close(); ?>
</body>
</html>
