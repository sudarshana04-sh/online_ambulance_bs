<?php include('aheader.php'); ?>
<?php include('functions.php'); ?>

<?php
$conn = new mysqli("localhost", "root", "", "ambulance");

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
";
$result = $conn->query($query);
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">View Bookings</h1>
            </div>
        </div>
        <!-- /. ROW -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="font-size: 10px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Ambulance Type</th>
                                <th>Vehicle Type</th>
                                <th>Driver Name</th>
                                <th>Hospital</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['booking_id']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['user_address']; ?></td>
                                    <td><?php echo $row['user_city']; ?></td>
                                    <td><?php echo $row['user_phone']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['atype']; ?></td>
                                    <td><?php echo $row['vtype']; ?></td>
                                    <td><?php echo $row['dname']; ?></td>
                                    <td><?php echo $row['hname']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($row['booking_date'])); ?></td>
                                    <td><?php echo date("h:i A", strtotime($row['booking_time'])); ?></td>
                                    <td><?php echo $row['notes']; ?></td>
                                </tr>
                            <?php } $conn->close(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer-sec">
    &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
</div>
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>