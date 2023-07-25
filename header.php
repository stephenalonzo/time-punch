<?php 

include_once('php/session.php');
require_once('controller.php');

if (isset($_SESSION['id']) && $_SESSION['id'])
{

    roleView($params);

} 

?>