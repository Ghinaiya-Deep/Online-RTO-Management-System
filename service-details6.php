<?php
require_once 'config.php'; // include the config file for database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Check Vehicle Registration Status</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

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
          <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="service-details1.php">Apply For LLR</a></li>
              <li><a href="service-details2.php">Check Status of LLR</a></li>
              <li><a href="service-details3.php">Apply For DL</a></li>
              <li><a href="service-details4.php">Check Status of DL</a></li>
              <li><a href="service-details5.php">Apply For Vehicle Registration</a></li>
              <li><a href="service-details6.php">Check Status of Vehicle Registration</a></li>
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
        <h1>Check Status of Vehicle Registration</h1>
      </div>
    </div><!-- End Page Title -->


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $registration_number = $_POST['registration-number'];
      $chassis_number = $_POST['chassis-number'];

      // Query to check the status of vehicle registration
      $query = "SELECT * FROM vehicle_registration WHERE registration_number = '$registration_number' AND chassis_number = '$chassis_number'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row['status']; // Get the status from the database
        if (empty($status)) { // If status is not set in the database, set it to "Pending" by default
          $status = "Pending";
        }
    ?>
      <br>
        <h2 style="text-align: center;">Vehicle Registration Status</h2>
        <Br>
        <div class="table-container">
          <table class="table table-bordered" style="margin: 0 auto; width: 50%; border-collapse: collapse;">
            <tr>
              <th style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd;">Applicant Name</th>
              <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['owner_name']; ?></td>
            </tr>
            <tr>
              <th style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd;">Vehicle Model</th>
              <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['vehicle_model']; ?></td>
            </tr>
            <tr>
              <th style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd;">Email ID</th>
              <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['owner_email']; ?></td>
            </tr>
            <tr>
              <th style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd;">Status</th>
              <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $status; ?></td>
            </tr>
          </table><br><Br>
          <?php if ($status == "approved") { ?>
            <br><br>
            <a href="download_vehicle.php?registration_number=<?php echo $row['registration_number']; ?>" class="btn btn-primary" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-left:620px; margin-bottom: 5px;">Download Driving License</a>
          <?php } ?><br><Br>
        </div>
      <?php
      } else {
        echo "<p>No record found with the given registration number and chassis number.</p>";
      }
    } else {
      // Display the form
      ?>
      <!-- Vehicle Registration Status Check Form -->
      <section class="section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <h2 class="text-center">Check Vehicle Registration Status</h2>
              <form id="vehicle-registration-status-form" action="#" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <label for="registration-number">Registration Number:</label>
                    <input type="text" id="registration-number" name="registration-number" required>
                  </div>
                  <div class="col-md-6">
                    <label for="chassis-number">Chassis Number:</label>
                    <input type="text" id="chassis-number" name="chassis-number" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Check Status</button>
                  </div>
                </div>
              </form>
              <div id="vehicle-registration-status-result"></div>
            </div>
          </div>
        </div>
      </section>
    <?php
    }
    ?>

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
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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