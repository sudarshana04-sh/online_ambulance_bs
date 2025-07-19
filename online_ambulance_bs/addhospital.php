<?php include('aheader.php'); ?>
<?php 

$n = 3;
function getRandomString($n)
{
  $characters = '0123456789';
  $randomString = 'HOS-';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}
?>
<?php  
$result='';
  if(isset($_POST['insert'])){
    
    extract($_POST);
       
    $mysqli = new mysqli("localhost",'root','','ambulance');
    $sql = "INSERT INTO `add_hospital`(`hid`, `hname`, `hemail`, `haddress`, `hcity`, `hstate`, `hphone`) VALUES ('$hid','$hname','$hemail','$haddress','$hcity','$hstate','$hphone')";
    $res = $mysqli->query($sql);
          //header("location: add.php");
          $result='<div class="alert alert-success">Hospital Added Successfully</div>';   
}
?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Add Hospital</h1>
                        <strong><?php echo $result; ?></strong>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Hospital ID</label>
      <input type="text" class="form-control" id="hid" name="hid" value="<?php echo getRandomString($n); ?>" readonly>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Hospital Name</label>
      <input type="text" class="form-control" id="hname" name="hname">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Email Address</label>
      <input type="email" class="form-control" id="hemail" name="hemail">
    </div>
  </div>
   <div class="form-group">
    <label for="inputAddress">Hospital Address</label>
    <textarea class="form-control" id="haddress" name="haddress"></textarea>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="hcity" name="hcity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <input type="text" class="form-control" id="hstate" name="hstate">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Phone Number</label>
      <input type="text" class="form-control" id="hphone" name="hphone">
    </div>
  </div>
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
