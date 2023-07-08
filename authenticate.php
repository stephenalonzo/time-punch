<?php 

// prevent user from accessing main page if their session is not set

if (!isset($_SESSION['id']) && !$_SESSION['id'])
{

    header("Location: login.php");

}

?>