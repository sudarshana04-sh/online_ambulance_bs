<?php include('aheader.php'); ?>
<?php include('functions.php'); ?>
<?php
$display = "";
$conn = new mysqli("localhost", "root", "", "ambulance");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM add_hospital WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update'])) {
    extract($_POST);

    if (empty($hname) || empty($haddress) || empty($hcontact)) {
        $display = '<div class="alert alert-success">Please fill all fields</div>';
    } else {
        $stmt = $conn->prepare("UPDATE add_hospital SET hname=?, haddress=?, hphone=? WHERE id=?");
        $stmt->bind_param("sssi", $hname, $haddress, $hcontact, $id);
        if ($stmt->execute()) {
            $display = '<div class="alert alert-success">Hospital Updated Successfully</div>';
        } else {
            $display = '<div class="alert alert-success">! Error in updating hospital</div>';
        }
        $stmt->close();
    }
}
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Update Hospital</h1>
                <strong><?php echo $display; ?></strong>
            </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Hospital Name</label>
                            <input type="text" class="form-control" name="hname" value="<?php echo $row['hname']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hospital Address</label>
                            <input type="text" class="form-control" name="haddress" value="<?php echo $row['haddress']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hospital Contact</label>
                            <input type="text" class="form-control" name="hcontact" value="<?php echo $row['hphone']; ?>">
                        </div>
                    </div>
                    <br><br><br><br>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<div id="footer-sec">
    &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
</div>
<!-- FOOTER -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>