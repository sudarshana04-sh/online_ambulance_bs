<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ambulance";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle ambulance ID
$ambulance = null;
if (isset($_POST['ambulance_id'])) {
    $id = intval($_POST['ambulance_id']);
    $stmt = $conn->prepare("SELECT * FROM `add_ambulance` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ambulance = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>
<?php
$display="";
$conn = new mysqli("localhost",'root','','ambulance');
if (isset($_POST['insert'])) {
    // Retrieve form data
   extract($_POST);

    // Validate inputs
   
        // Prepare SQL query
        $query = "INSERT INTO `bookings`(`ambulance_id`, `user_name`, `user_address`, `user_city`, `user_phone`, `user_email`, `booking_date`, `booking_time`, `notes`) VALUES (?, ?, ?, ?, ?, ?,?,?,?)";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sssssssss", $ambulance_id, $user_name, $user_address, $user_city, $user_phone, $user_email, $booking_date, $booking_time, $notes);
            
            if ($stmt->execute()) {
              $display='<div class="alert alert-success">Booking Successfully</div>';   
            } else {
                $display='<div class="alert alert-success">! Error in Booking</div>';   
            }
            
            $stmt->close();
        } else {
            //echo "<script>alert('Database error: Could not prepare statement.');</script>";
        }
    }
    
    $conn->close();

?>
<!-- Begin HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Klinik - Clinic Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
           <img src="assets/img/logo.png" />
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
    </nav>

<div class="container my-5">
    <?php if ($ambulance): ?>
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Confirm Ambulance Booking</h4>
            </div>
            <br>
             <strong><?php echo $display; ?></strong>
            <div class="card-body">
                <h5>Ambulance Details</h5>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Type:</strong> <?= htmlspecialchars($ambulance['atype']) ?></li>
                    <li class="list-group-item"><strong>Vehicle:</strong> <?= htmlspecialchars($ambulance['vtype']) ?></li>
                    <li class="list-group-item"><strong>Contact:</strong> <?= htmlspecialchars($ambulance['acontact']) ?></li>
                    <li class="list-group-item"><strong>Driver:</strong> <?= htmlspecialchars($ambulance['dname']) ?> (<?= htmlspecialchars($ambulance['dphone']) ?>)</li>
                </ul>

                <form action="" method="POST">
                    <input type="hidden" name="ambulance_id" value="<?= $ambulance['id'] ?>">

                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Enter your Name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Enter your Address</label>
                        <input type="text" class="form-control" name="user_address" id="user_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Enter your City</label>
                        <input type="text" class="form-control" name="user_city" id="user_city" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Enter your Phone Number</label>
                        <input type="text" class="form-control" name="user_phone" id="user_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Enter your Email</label>
                        <input type="text" class="form-control" name="user_email" id="user_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input type="date" class="form-control" name="booking_date" id="booking_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="booking_time" class="form-label">Booking Time</label>
                        <input type="time" class="form-control" name="booking_time" id="booking_time" required>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Additional Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control" placeholder="Optional message..."></textarea>
                    </div>

                    <button type="submit" name="insert" class="btn btn-success">Confirm Booking</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger mt-5">
            Ambulance not found or invalid request.
        </div>
    <?php endif; ?>
</div>

<div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Cardiology</a>
                    <a class="btn btn-link" href="">Pulmonary</a>
                    <a class="btn btn-link" href="">Neurology</a>
                    <a class="btn btn-link" href="">Orthopedics</a>
                    <a class="btn btn-link" href="">Laboratory</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>