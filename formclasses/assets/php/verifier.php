<?php
session_start();

if(isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'admin')
{
    header('Location: /profile/adminprofile/index.php');
}
else if(isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'buyer')
{
    header('Location: /profile/clientprofile/index.php');
}
else if(isset($_SESSION['accountType']) && $_SESSION['accountType'] == 'seller')
{
    header('Location: /profile/sellerprofile/index.php');
}
else
{
    echo '<script>
    alert("Login to your account to access this page");
    window.location.href = "/forms/login.html";
    </script>';
}
?>