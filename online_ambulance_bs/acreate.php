 <?php  
$message = ""; 
  if(isset($_POST['insert'])){
    
    extract($_POST);
      
    $mysqli = new mysqli("localhost",'root','','ambulance');
    $sql = "INSERT INTO `alogin`(`aname`, `aphone`, `aemail`, `ausername`, `apassword`) VALUES ('$aname','$aphone','$aemail','$ausername','$apassword')";
    //$res = $mysqli->query($sql);
    if ($mysqli->query($sql) === TRUE) {
        $message = "Account created successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
          //header("location: index.php");   
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book-My-Ambulance</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="assets/img/logo.png" />
            </div>
        </div>
        <center><h3>Administrator Create login Creadentials</h3></center>
         <div class="row ">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="POST">
                                    <hr />
                                    <h5>Enter Details to Create Account</h5>
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control" name="aname" id="aname" placeholder="Enter Adminustrator Name " />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
                                            <input type="text" class="form-control" name="aphone" id="aphone" placeholder="Enter Adminustrator Phone Number " />
                                        </div>
                                         <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"  ></i></span>
                                            <input type="email" class="form-control" name="aemail" id="aemail" placeholder="Enter Adminustrator Email " />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="ausername" id="ausername" placeholder="Enter Adminustrator Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" name="apassword" id="apassword"  placeholder="Enter Administrator Password" />
                                        </div>
                                    
                                     
                                     <input type="submit" name="insert" class="btn btn-primary " value="Create Account">
                                    <hr />
                                    Already registerd ? <a href="login.php" >click here to Login</a>
                                    </form>
                            </div>
                           
                        </div>
                
                
        </div>
    </div>
<?php if (!empty($message)): ?>
        <script>
            alert("<?php echo $message; ?>"); // Show alert message
            window.location.href = window.location.href; // Refresh the page
        </script>
    <?php endif; ?>
</body>
</html>
