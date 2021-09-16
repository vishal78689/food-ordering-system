<?php
include('../config/config.php');
  //destroy the session
  //redirect
  session_destroy();
  header('location:'.SITEURL.'admin/login.php');

?>