<?php include('aheader.php'); ?>
<?php include('functions.php'); ?>
<?php
$display = "";
$conn = new mysqli("localhost", "root", "", "ambulance");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM add_ambulance WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update'])) {
    extract($_POST);

    if ($hname == 'Select Any' || $atype == 'Select Any' || $vtype == 'Select Any' || empty($acontact) || empty($dname) || empty($dphone)) {
        $display = '<div class="alert alert-success">Please select the fields</div>';
    } else {
        $stmt = $conn->prepare("UPDATE add_ambulance SET hname=?, atype=?, vtype=?, acontact=?, dname=?, dphone=? WHERE id=?");
        $stmt->bind_param("ssssssi", $hname, $atype, $vtype, $acontact, $dname, $dphone, $id);
        if ($stmt->execute()) {
            $display = '<div class="alert alert-success">Ambulance Updated Successfully</div>';
        } else {
            $display = '<div class="alert alert-success">! Error in form submission</div>';
        }
        $stmt->close();
    }
}
?>

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Update Ambulance</h1>
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
                            <select id="hname" name="hname" class="form-control">
                                <option>Select Any</option>
                                <?php get_hospital($data['hname']); ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ambulance Type</label>
                            <select class="form-control" id="atype" name="atype">
                                <option>Select Any</option>
                                <?php
                                $types = [
                                    "Basic Life Support (BLS) Ambulances",
                                    "Advanced Life Support (ALS) Ambulances",
                                    "Intensive Care Unit (ICU) Ambulance",
                                    "Dead Body Ambulance"
                                ];
                                foreach ($types as $type) {
                                    $selected = ($data['atype'] == $type) ? 'selected' : '';
                                    echo "<option value=\"$type\" $selected>$type</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ambulance Vehicle Type</label>
                            <select class="form-control" id="vtype" name="vtype">
                                <option>Select Any</option>
                                <option value="Petrol" <?php if ($data['vtype'] == 'Petrol') echo 'selected'; ?>>Petrol</option>
                                <option value="Diesel" <?php if ($data['vtype'] == 'Diesel') echo 'selected'; ?>>Diesel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Ambulance Contact Number</label>
                            <input type="text" class="form-control" id="acontact" name="acontact" value="<?php echo $data['acontact']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Driver's Name</label>
                            <input type="text" class="form-control" id="dname" name="dname" value="<?php echo $data['dname']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Driver's Phone Number</label>
                            <input type="text" class="form-control" id="dphone" name="dphone" value="<?php echo $data['dphone']; ?>">
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
<!-- SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>