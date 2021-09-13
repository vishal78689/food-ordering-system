<?php

//start session
session_start();

define('SITEURL','http://localhost/food-ordering-system/');
//execute query
$conn=mysqli_connect('localhost','root','mysqlpass') or die(mysqli_error()); // database connection
$db_select=mysqli_select_db($conn,'mvit_canteen') or die(mysqli_error());
?>