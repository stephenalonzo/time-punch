<?php 

// Prevent user from accessing main page if their session is not set/user not logged in

if (!isset($_SESSION['id']) && !$_SESSION['id'])
{

    header("Location: login.php");

}

?>