<?php
//check whether user is logged or not

if(!isset($_SESSION['user']))
{
$_SESSION['no-login']="<div class='error'>Please Login To Access Admin Panel</div>";

header('location:'.SITEURL.'admin/login.php');
}

?>