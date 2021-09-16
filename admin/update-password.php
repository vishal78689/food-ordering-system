<?php
include('components/menu.php');?>

<div class="main-content">
<div class="wrapper">
 <h1>  Change Password</h1>
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
      <td>Current Password</td>
      <td><input type="password" name="current_password" placehorder="Old Password"/></td>
  </tr>
  <tr>
      <td>New Password</td>
      <td><input type="password" name="new_password" placehorder="New Password"/></td>
  </tr>
  <tr>
      <td>Confirm Password</td>
      <td><input type="password" name="confirm_password" placehorder="Confirm Password"/></td>
  </tr>
  
  <tr>
      <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <input type="submit" name="submit" value="Change Password" clas="btn-secondary"/>
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
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);



    $sql="SELECT * FROM tbl_admin WHERE
    id=$id AND password ='$current_password'";  
    
    
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
 
if($res==TRUE){

    
  $count=mysqli_num_rows($res);

  if($count==1){
        $rows=mysqli_fetch_assoc($res);
       
  if($new_password==$confirm_password){
    $sql2="UPDATE tbl_admin SET
    password ='$new_password' 
    WHERE id=$id";  
    
    
    $res2=mysqli_query($conn,$sql2) or die(mysqli_error());
   
    if($res2==TRUE){
        $_SESSION['changed']="<div class='success'>Password Changed Succesfully</div>";
        header('location:'.SITEURL.'admin/admin-manage.php');
    }


}
  else{
    $_SESSION['not-match']="<div class='error'>Password Not Match</div>";
    header('location:'.SITEURL.'admin/admin-manage.php');

  }

    //data inserted
  
}
else{
    $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
    header('location:'.SITEURL.'admin/admin-manage.php');
}


}
}

?>

 











<?php include('components/footer.php');?>