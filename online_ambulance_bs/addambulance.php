<?php include('aheader.php'); ?>
<?php include('functions.php'); ?>
<?php
$display="";
$conn = new mysqli("localhost",'root','','ambulance');
if (isset($_POST['insert'])) {
    // Retrieve form data
   extract($_POST);

    // Validate inputs
    if ($hname == 'Select Any' || $atype == 'Select Any' || $vtype == 'Select Any' || empty($acontact) || empty($dname) || empty($dphone)) {
        $display='<div class="alert alert-success">Please select the fields</div>';   
    } else {
        // Prepare SQL query
        $query = "INSERT INTO `add_ambulance` (hname, atype, vtype, acontact, dname, dphone) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ssssss", $hname, $atype, $vtype, $acontact, $dname, $dphone);
            
            if ($stmt->execute()) {
              $display='<div class="alert alert-success">Ambulance Added Successfully</div>';   
            } else {
                $display='<div class="alert alert-success">! Error in form submission</div>';   
            }
            
            $stmt->close();
        } else {
            //echo "<script>alert('Database error: Could not prepare statement.');</script>";
        }
    }
    
    $conn->close();
}
?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Add Ambulance</h1>
                         <strong><?php echo $display; ?></strong>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Hospital Name</label>
      <select id="hname" name="hname" class="form-control" >
        <option selected>Select Any</option>
        <?php get_hospital(); ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Ambulance Type</label>
      <select class="form-control" id="atype" name="atype">
        <option>Select Any</option>
        <option value="Basic Life Support (BLS) Ambulances">Basic Life Support (BLS) Ambulances</option>
        <option value="Advanced Life Support (ALS) Ambulances">Advanced Life Support (ALS) Ambulances</option>
        <option value="Intensive Care Unit (ICU) Ambulance">Intensive Care Unit (ICU) Ambulance</option>
        <option value="Dead Body Ambulance">Dead Body Ambulance</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Ambulance Vehicle Type</label>
      <select class="form-control" id="vtype" name="vtype">
        <option>Select Any</option>
        <option value="Petrol">Petrol</option>
        <option value="Diesel">Diesel</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputAddress">Ambulance Contact Number</label>
    <input type="text" class="form-control" id="acontact" name="acontact">
    </div>
    <div class="form-group col-md-4">
      <label for="inputCity">Driver's Name</label>
      <input type="text" class="form-control" id="dname" name="dname">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Driver's Phone Number</label>
      <input type="text" class="form-control" id="dphone" name="dphone">
    </div>
   
  </div>
  <br><br><br><br>
  <button type="submit" name="insert" class="btn btn-primary">Add</button>
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
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
