<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DL Service</title>
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

<style>
    /* Style the appointment details table */
    .appointment-details-table {
      margin-top: 20px;
      border-collapse: collapse;
      width: 100%;
    }

    .appointment-details-table th,
    .appointment-details-table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    .appointment-details-table th {
      background-color: #f0f0f0;
      text-align: center;
    }

    .appointment-details-table td {
      background-color: #ffffff;
      text-align: center;
    }

    .appointment-details-table th:first-child,
    .appointment-details-table td:first-child {
      padding-left: 20px;
    }

    .appointment-details-table th:last-child,
    .appointment-details-table td:last-child {
      padding-right: 20px;
    }
  </style>
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
        <h1>Apply For Driving License</h1>
      </div>
    </div><!-- End Page Title -->
    <?php
    require_once 'config.php';

    // Initialize success message
    $success_message = "";
    $show_form = true;

    // Process form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $applicant_name = $_POST["applicant_name"];
      $father_name = $_POST["father_name"];
      $date_of_birth = $_POST["date_of_birth"];
      $gender = $_POST["gender"];
      $address = $_POST["address"];
      $city = $_POST["city"];
      $state = $_POST["state"];
      $pincode = $_POST["pincode"];
      $mobile_number = $_POST["mobile_number"];
      $email_id = $_POST["email_id"];
      $license_type = $_POST["license_type"];
      $vehicle_class = $_POST["vehicle_class"];
      $payment_method = $_POST["payment_method"];

      // Check if file is uploaded
      if (isset($_FILES["upload_documents"])) {
        $upload_documents = $_FILES["upload_documents"]["name"];
      } else {
        $upload_documents = "";
      }

      $applicant_id = rand(1000000, 9999999); // Generate a random application ID
      // Insert data into database
      $sql = "INSERT INTO dl_applications (applicant_name, father_name, date_of_birth, gender, address, city, state, pincode, mobile_number, email_id, license_type, vehicle_class, payment_method, upload_documents, applicant_id) VALUES ('$applicant_name', '$father_name', '$date_of_birth', '$gender', '$address', '$city', '$state', '$pincode', '$mobile_number', '$email_id', '$license_type', '$vehicle_class', '$payment_method', '$upload_documents', '$applicant_id')";

      if ($conn->query($sql) === TRUE) {
        $success_message = "Your application has been submitted successfully. Your application ID is: $applicant_id";
      } else {
        $success_message = "Error: " . $sql . "<br>" . $conn->error;
      }
      // Close connection
      $conn->close();

       // Autogenerated date, time, and default place
      $visit_date = date('Y-m-d', strtotime('+2 days')); // Date after 2 days of registration
      $visit_time = '10:00 AM'; // Default time
      $visit_place = 'RTO Office, Nashik'; // Default place
    }
    ?>
    <br>
    <!-- Display success message -->
    <?php if ($success_message != "") { ?>
      <div class="alert alert-success">

        <strong>Success!</strong>
        <?php echo $success_message; ?>
      </div>
    <?php } ?>

     <!-- Display the visit details in a table -->
      <div class="container mt-4">
        <h3 style="text-align:center; font-weight: bold;">Driving License Appointment Details</h3>
        <table class="table table-bordered appointment-details-table">
          <thead>
            <tr>
              <th>Registration ID</th>
              <th>Date</th>
              <th>Place</th>
              <th>Time</th>
              <th>Service Type</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $applicant_id; ?></td>
              <td><?php echo $visit_date; ?></td>
              <td><?php echo $visit_place; ?></td>
              <td><?php echo $visit_time; ?></td>
              <td><?php echo "DL"?></td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php } ?>
    <?php if ($success_message == "") { ?>

    <!-- Driving License Registration Form -->
    <div class="container pt-5">
      <h2 class="text-center">Driving License Registration Form</h2>
      <form action="#" method="post">
        <div class="row">
          <div class="col-md-6">
            <label for="applicant_name">Applicant Name:</label>
            <input type="text" id="applicant_name" name="applicant_name" required>
          </div>
          <div class="col-md-6">
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
          </div>
          <div class="col-md-6">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
              <option value="">Select</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
          </div>
          <div class="col-md-6">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>
          </div>
          <div class="col-md-6">
            <label for="pincode">Pincode:</label>
            <input type="number" id="pincode" name="pincode" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="mobile_number">Mobile Number:</label>
            <input type="tel" id="mobile_number" name="mobile_number" required>
          </div>
          <div class="col-md-6">
            <label for="email_id">Email ID:</label>
            <input type="email" id="email_id" name="email_id" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="license_type">License Type:</label>
            <select id="license_type" name="license_type" required>
              <option value="">Select</option>
              <option value="Permanent license">Permanent License</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="vehicle_class">Vehicle Class:</label>
            <select id="vehicle_class" name="vehicle_class" required>
              <option value="">Select</option>
              <option value="Two Wheeler">Two Wheeler</option>
              <option value="Four Wheeler">Four Wheeler</option>
              <option value="Heavy Vehicle">Heavy Vehicle</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
              <option value="">Select</option>
              <option value="Online Payment">Online Payment (Rs. 500)</option>

            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="upload_documents">Upload Documents:</label>
            <input type="file" id="upload_documents" name="upload_documents" required>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
 <?php } ?>
  </main>


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
