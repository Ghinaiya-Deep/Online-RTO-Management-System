<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $owner_name = $_POST["owner_name"];
  $owner_email = $_POST["owner_email"];
  $vehicle_type = $_POST["vehicle_type"];
  $vehicle_model = $_POST["vehicle_model"];
  $vehicle_year = $_POST["vehicle_year"];
  $engine_number = $_POST["engine_number"];
  $chassis_number = $_POST["chassis_number"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $pincode = $_POST["pincode"];
  $upload_documents = $_POST["upload_documents"];
  $payment_method = $_POST["payment_method"];


  $registration_number = rand(10000, 99999); // generate a 5-digit random number

  $query = "INSERT INTO vehicle_registration (owner_name, owner_email, vehicle_type, vehicle_model, vehicle_year, engine_number, chassis_number, address, city, state, pincode, payment_method, upload_documents,registration_number) 
  VALUES ('$owner_name', '$owner_email', '$vehicle_type', '$vehicle_model', '$vehicle_year', '$engine_number', '$chassis_number', '$address', '$city', '$state', '$pincode', '$payment_method', '$upload_documents', '$registration_number')";

  // Check if file is uploaded
  if (isset($_FILES["upload_documents"])) {
    $upload_documents = $_FILES["upload_documents"]["name"];
  } else {
    $upload_documents = "";
  }
  
  if (mysqli_query($conn, $query)) {
    $message = "Registration successful! Your registration number is: $registration_number";
  } else {
    $message = "Error: " . mysqli_error($conn);
  }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Apply Vehicle Registration</title>
  <meta name="description" content>
  <meta name="keywords" content>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
    rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="service-details-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">RTO Of Maharashtra</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#about">About</a></li>

          <li><a href="gallery.html">Gallery</a></li>
          <li class="dropdown"><a href="#"><span>Services</span> <i
                class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="service-details1.php">Apply For LLR</a></li>
              <li><a href="service-details2.php">Check Status of LLR</a></li>
              <li><a href="service-details3.php">Apply For DL</a></li>
              <li><a href="service-details4.php">Check Status of DL</a></li>
              <li><a href="service-details5.php">Apply For Vehicle Registration</a></li>
              <li><a href="service-details6.php">Check Status of Vehicle
                  Registration</a></li>
            </ul>
          </li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container position-relative">
        <h1>Apply For Vehicle Registration</h1>
      </div>
    </div><!-- End Page Title -->
    <br><Br>

    <?php if (!empty($message)) { ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php } ?>

    <!-- Vehicle Registration Form -->
    <section class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 class="text-center">Vehicle Registration Form</h2>
            <form id="vehicle-registration-form" action="#" method="post">
              <div class="row">
                <div class="col-md-6">
                  <label for="owner_name">Owner's Name:</label>
                  <input type="text" id="owner_name" name="owner_name" required>
                </div>
                <div class="col-md-6">
                  <label for="owner_email">Owner's Email:</label>
                  <input type="email" id="owner_email" name="owner_email" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="vehicle_type">Vehicle Type:</label>
                  <select id="vehicle_type" name="vehicle_type" required>
                    <option value="">Select Vehicle Type</option>
                    <option value="Two Wheeler">Two Wheeler</option>
                    <option value="Four Wheeler">Four Wheeler</option>
                    <option value="Commercial Vehicle">Commercial Vehicle</option>
                  </select>
                </div>

              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="vehicle_model">Vehicle Model:</label>
                  <input type="text" id="vehicle_model" name="vehicle_model" required>
                </div>
                <div class="col-md-6">
                  <label for="vehicle_year">Vehicle Year:</label>
                  <input type="number" id="vehicle_year" name="vehicle_year" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="engine_number">Engine Number:</label>
                  <input type="text" id="engine_number" name="engine_number" required>
                </div>
                <div class="col-md-6">
                  <label for="chassis_number">Chassis Number:</label>
                  <input type="text" id="chassis_number" name="chassis_number" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="address">Address:</label>
                  <textarea id="address" name="address" required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="city">City:</label>
                  <input type="text" id="city" name="city" required>
                </div>
                <div class="col-md-6">
                  <label for="state">State:</label>
                  <input type="text" id="state" name="state" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="pincode">Pincode:</label>
                  <input type="number" id="pincode" name="pincode" required>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <label for="payment_method">Payment Method:</label>
                  <select id="payment_method" name="payment_method" required>
                    <option value="">Select</option>
                    <option value="Online Payment">Online Payment (Rs. 1000)</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="upload_documents">Upload Documents:</label>
                  <input type="file" id="upload_documents" name="upload_documents" required>
                </div>
              </div>
              <Br>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer" class="footer dark-background">
      <div class="copyright">
        <span>Copyright</span> <strong
          class="px-1 sitename">RTO Of Maharashtra</strong> <span>All Rights
          Reserved</span>
      </div>
      <div class="credits">
        Designed by Deep Ghinaiya and Gaurav Kalawadiya</a>
      </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>