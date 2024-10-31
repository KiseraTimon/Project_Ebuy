<?php
session_start();

if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin')
{
    header('Location: /profile/adminprofile/index.php');
}
else if(isset($_SESSION['userType']) && $_SESSION['userType'] == 'client')
{
    header('Location: /profile/clientprofile/index.php');
}
else
{
    echo '<script>
    alert("Login to your account to access this page");
    window.location.href = "/forms/login.html";
    </script>';
}
?>