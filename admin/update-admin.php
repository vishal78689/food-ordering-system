<?php
include('components/menu.php');?>

<div class="main-content">
<div class="wrapper">
 <h1> Update Admin</h1>
 <br/><br/>
<?php
//get id

$id=$_GET['id'];
$sql="SELECT * FROM tbl_admin WHERE id=$id";

$res=mysqli_query($conn,$sql);

if($res==TRUE){
  //echo "Admin update";




  $count=mysqli_num_rows($res);

  if($count==1){
        $rows=mysqli_fetch_assoc($res);
        $full_name=$rows['full_name'];
        $username=$rows['username'];


    

  }
  else{
    header('location:'.SITEURL.'admin/admin-manage.php');
  }
  
  


}


?>

 <form action="" method="POST">
   <table class="tbl-30">
  <tr>
      <td>Full Name</td>
      <td><input type="text" name="full_name" value="<?php echo $full_name?>"/></td>
  </tr>
  <tr>
      <td>Username</td>
      <td><input type="text" name="username" value="<?php echo $username?>"/></td>
  </tr>
  
  <tr>
      <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <input type="submit" name="submit" value="Update Admin" clas="btn-secondary"/>
      </td>
  </tr>
   </table>


 </form>
</div>
</div>
<?php
if(isset($_POST["submit"])){
    // echo "Clicked";
    //get data from form
     $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    $sql="UPDATE tbl_admin SET 
    full_name='$full_name',
    username='$username'
    WHERE id='$id'";  
    
    
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
 
if($res==TRUE){
    //data inserted
    $_SESSION['update']="<div class='success'>Admin Updated Succesfully</div>";
    header('location:'.SITEURL.'admin/admin-manage.php');
}
else{
    $_SESSION['update']="<div class='error'>Admin Not Updated Succesfully</div>";
    header('location:'.SITEURL.'admin/admin-manage.php');
}


}

?>

 











<?php include('components/footer.php');?>