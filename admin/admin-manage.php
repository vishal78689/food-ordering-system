
<?php include('components/menu.php');?>

<div class="main-content">
<div class="wrapper">
 <h1> Manage Admin</h1>
 <br/>

 <?php
 if(isset($_SESSION['add'])){
     echo $_SESSION['add'];
     unset($_SESSION['add']);
 }
 ?>
 <br/> <br/>
<a href="add-admin.php" class="btn-primary">Add Admin</a> <!-- WE WILL CHANGE-->

<br/><br/><br/>

 <table class="tbl-full">
     <tr>
         <th>S.N </th>
         <th>Full Name </th>
         <th>Username </th>
         <th>Actions </th>
     </tr>

     
 <?php

 $sql="SELECT * FROM tbl_admin";
 $res=mysqli_query($conn,$sql);
 if($res==TRUE){
     $count=mysqli_num_rows($res); //rows
     if($count>0){
          $sn=1;

        while($rows=mysqli_fetch_assoc($res)){
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];

            ?>

    <tr>
         <td><?php echo $sn++;?></td>
         <td><?php echo $full_name;?></td>
         <td><?php echo $username;?></td>
         <td>
         <a href="#" class="btn-secondary">Update Admin</a>
         <a href="#" class="btn-danger">Delete Admin</a>
         </td>
     </tr>

            <?php
        }
     }
 }
 ?>
     
 </table>
</div>
</div>
<?php include('components/footer.php');?>
</body>

</html>

