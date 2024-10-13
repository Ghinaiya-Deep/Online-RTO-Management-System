<?php
session_start();
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE admin_username='$username' AND admin_password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $login = true;
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['message'] = "You have successfully logged in!";
        header("location: admin.html");
        exit();
    } else {
        $showError = "Invalid Credentials";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Register/Login</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <style>
        /* Admin Login Page Styles */

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        .header {
            background-color: #2a2c39;
            padding: 15px 0;
        }

        .header .sitename {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }

        .navmenu ul {
            list-style-type: none;
            padding: 0;
        }

        .navmenu ul li {
            display: inline;
            margin-right: 20px;
        }

        .navmenu ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .navmenu ul li a:hover {
            color: #64b5f6;
        }

        /* Main Content Styles */
        .main {
            padding: 50px 0;
        }

        .page-title {
            background-color: #2a2c39;
            color: #ffffff;
            padding: 30px 0;
            margin-bottom: 40px;
        }

        .page-title h1 {
            font-size: 32px;
            margin: 0;
        }

        /* Login Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #1a237e;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbdefb;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #1976d2;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1565c0;
        }

        /* Error Messages */
        .text-danger {
            color: #d32f2f;
            margin-top: 10px;
        }

        /* Footer Styles */
        .footer {
            background-color: #2a2c39;
            color: #ffffff;
            padding: 40px 0;
            text-align: center;
        }

        .footer h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer p {
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto 20px;
        }


        .copyright {
            margin-top: 20px;
            font-size: 14px;
        }

        /* Header Styles */
        .header {
            background-color: #333;
            padding: 15px 0;
        }

        .header .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .sitename {
            color: #f0f4f8;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .navmenu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .navmenu ul li {
            margin-left: 20px;
        }

        .navmenu ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .navmenu ul li a:hover {
            color: #64b5f6;
        }

        .navmenu ul li.right-menu {
            margin-left: auto;
        }
    </style>
</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="admin.html" class="logo d-flex align-items-center">

                <h1 class="sitename">RTO Of Maharashtra</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>


                    <li class="nav-item">
                        <a class="nav-link" href="#">Login</a>
                    </li>

                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    <li class="nav-item">

                    </li>
            </nav>

        </div>
        </nav>

    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background">
            <div class="container position-relative">
                <h1>Login to our website</h1>
            </div>
        </div><!-- End Page Title -->


        <div class="container my-4">
            <h1 class="text-center">Login to our website</h1>
            <?php if (isset($_SESSION['message'])) { ?>
                <p class="text-success"><?php echo $_SESSION['message']; ?></p>
            <?php } ?>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="username">Admin Name</label>
                    <input type="text" class="form-control" id="admin_username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="admin_password" name="password">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Login</button>
                <?php if ($showError) { ?>
                    <p class="text-danger"><?php echo $showError; ?></p>
                <?php } ?>
            </form>
        </div>


        <br><br>
    </main>


    <footer id="footer" class="footer dark-background">
        
            <div class="container">
                <div class="copyright">
                    <span>Copyright</span> <strong class="px-1 sitename">Selecao</strong> <span>All Rights Reserved</span>
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    Designed by Deep Ghinaiya and Guarav Kalawadiya </a>
                </div>
            </div>
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