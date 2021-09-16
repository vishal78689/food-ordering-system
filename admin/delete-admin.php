<?php
 include('../config/config.php');
$id=$_GET['id'];
$sql="DELETE FROM tbl_admin WHERE id=$id";

$res=mysqli_query($conn,$sql);

if($res==TRUE){
  //echo "Admin Deleted";
  //crete session var
  $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div>";
  header('location:'.SITEURL.'admin/admin-manage.php');


}
else{
//echo "Admin Not Deleted";
$_SESSION['delete']="<div class='error'>Failed To Delete</div>";  
header('location:'.SITEURL.'admin/admin-manage.php');

}

?>
