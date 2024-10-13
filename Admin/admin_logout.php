<?php
// Start the session
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['loggedin'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Clear the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Redirect to the login page or home page
    header("Location: admin_login.php");
    exit();
} else {
    // If the user is not logged in as an admin, redirect to an error page or home page
    header("Location: error.php");
    exit();
}
?>