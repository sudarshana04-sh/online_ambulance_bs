<?php
$result="";
    //ob_start();
    //session_start();
     //$cemail = $_SESSION['cemail'];
$con=new mysqli("localhost", "root", "", "ambulance");
    
    //Response.Cache.SetNoStore();
    if(isset($_POST['login']))
    {
        $ausername = $_POST['ausername'];
       $apassword = $_POST['apassword'];
        $check_email = "SELECT * FROM `alogin` WHERE ausername = '$ausername' AND apassword='$apassword'";
        $check_email_run = mysqli_query($con, $check_email);
        $result = mysqli_num_rows($check_email_run);
        if($result > 0)
        {
            $row1 = mysqli_fetch_assoc($check_email_run);
            //$username=$row1['username'];
            //$password=$row1['password'];
            header('Location: adash.php');
       //$_SESSION['uemail'] = $uemail;
        
        }
        //else
        //{
            $result='<div class="alert alert-success">Invalid Login Credentials</div>';

  //} 
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
        <center><h3>Administrator Login</h3></center>
         <div class="row ">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="POST">
                                    <hr />
                                    <h5>Enter Details to Login</h5>
                                    <strong><?php echo $result; ?></strong>
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" name="ausername" id="ausername" placeholder="Enter Adminustrator Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" name="apassword" id="apassword"  placeholder="Enter Administrator Password" />
                                        </div>
                                    
                                     
                                     <input type="submit" name="login" class="btn btn-primary " value="Login">
                                    <hr />
                                    Not register ? <a href="acreate.php" >click here </a>
                                    </form>
                            </div>
                           
                        </div>
                
                
        </div>
    </div>

</body>
</html>
