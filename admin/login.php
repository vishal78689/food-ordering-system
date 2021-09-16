<?php include('../config/config.php');?>
<html>
<head>
    <title> Login</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }

         if(isset($_SESSION['no-login']))
        {
            echo $_SESSION['no-login'];
            unset($_SESSION['no-login']);
         }
        ?>
 <br/>
 <form action="" method="POST" class="text-center">
   Username <br/>
      <input type="text" name="username" placeholder="Enter Username"/>
      <br/><br/>
 Password
 <br/>

      <input type="password" name="password" placeholder="Enter Password"/>
  <br/><br/>
   <input type="submit" name="submit" value="Login" clas="btn-primary"/>
    


 </form>
    </div>
</body>

</html>

<?php



if(isset($_POST["submit"])){
    // echo "Clicked";
    //get data from form

    //  $username=$_POST['username'];
     $username=mysqli_real_escape_string($conn,$_POST['username']);
//   $password=md5($_POST['password'] );// encryption
  $password=mysqli_real_escape_string($conn,md5($_POST['password'] ));

$sql="SELECT * FROM tbl_admin WHERE
 username='$username' AND
 password='$password'" 
;

//excecute
$res=mysqli_query($conn,$sql) or die(mysqli_error());
 
$count=mysqli_num_rows($res);
if($count==1){
    $_SESSION['login']="<div class='success'>Login Succesfull</div>";
   
    $_SESSION['user']=$username;
    header('location:'.SITEURL.'admin/index.php');

  
}
else{
    $_SESSION['login']="<div class='error'>Username or Password did not match</div>";
    header('location:'.SITEURL.'admin/login.php');
}


}
?>