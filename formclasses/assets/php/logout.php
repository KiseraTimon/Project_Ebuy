<?php

// Session control
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // On clicking chrome back button, the user will not be able to go back to the previous page
    echo '<script>
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
        };
    }
    alert("You have been logged out successfully");window.location.href="/index.php";
    </script>';
} else {
    // If the user is not logged in, redirect them to the login page
    echo '<script>
    alert("You are not logged in.");
    if (window.history && window.history.pushState) {
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, null, window.location.href);
        };
    }
    window.location.href="/pages/authPages/signin.html";
    </script>';
}
?>