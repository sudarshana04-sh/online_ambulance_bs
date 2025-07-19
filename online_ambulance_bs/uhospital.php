<?php include('aheader.php'); ?>
<?php include('functions.php'); ?>

<?php
$conn = new mysqli("localhost", "root", "", "ambulance");
$query = "SELECT * FROM add_hospital";
$result = $conn->query($query);
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Update Hospital Records</h1>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hospital Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['hname']; ?></td>
                                    <td><?php echo $row['haddress']; ?></td>
                                    <td><?php echo $row['hphone']; ?></td>
                                    <td>
                                        <a href="update_hospital.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Update</a>
                                    </td>
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