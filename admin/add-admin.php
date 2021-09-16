<?php include('components/menu.php');?>



<div class="main-content">
<div class="wrapper">
 <h1> Add Admin</h1>
 <br/><br/>

 
 <?php
 if(isset($_SESSION['add'])){
     echo $_SESSION['add'];
     unset($_SESSION['add']);
 }
 ?>
 <form action="" method="POST">
   <table class="tbl-30">
  <tr>
      <td>Full Name</td>
      <td><input type="text" name="full_name" placeholder="Enter Admin Name"/></td>
  </tr>
  <tr>
      <td>Username</td>
      <td><input type="text" name="username" placeholder="Enter Username"/></td>
  </tr>
  <tr>
      <td>Password</td>
      <td><input type="password" name="password" placeholder="Enter Password"/></td>
  </tr>
  <tr>
      <td colspan="2">
          <input type="submit" name="submit" value="Add Admin" clas="btn-secondary"/>
      </td>
  </tr>
   </table>


 </form>
</div>
</div>

 



<?php include('components/footer.php');?>

<?php

 //check whether button is clicked or not
 if(isset($_POST["submit"])){
    // echo "Clicked";
    //get data from form

    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
  $password=md5($_POST['password'] );// encryption


$sql="INSERT INTO tbl_admin SET
full_name='$full_name',
 username='$username',
 password='$password'" 
;

//excecut
$res=mysqli_query($conn,$sql) or die(mysqli_error());
 
if($res==TRUE){
    //data inserted
    $_SESSION['add']="<div class='success'>Admin Added Succesfully</div>";
    header('location:'.SITEURL.'admin/admin-manage.php');
}
else{
    $_SESSION['add']="<div class='error'>Admin Not Added Succesfully</div>";
    header('location:'.SITEURL.'admin/add-admin.php');
}

}

?>