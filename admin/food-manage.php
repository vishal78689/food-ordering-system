<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
 <h1> Manage Food</h1>
 <br/>
 <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a> <!-- WE WILL CHANGE-->

<br/><br/><br/>
<?php
  if(isset($_SESSION['add-food']))
  {
      echo $_SESSION['add-food'];
      unset($_SESSION['add-food']);
   }

   if(isset($_SESSION['remove']))
  {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
   }
   if(isset($_SESSION['upload']))
   {
       echo $_SESSION['upload'];
       unset($_SESSION['upload']);
    }
    if(isset($_SESSION['failed-remove']))
    {
        echo $_SESSION['failed-remove'];
        unset($_SESSION['failed-remove']);
     }
     if(isset($_SESSION['update']))
     {
         echo $_SESSION['update'];
         unset($_SESSION['update']);
      }
      if(isset($_SESSION['not-found']))
     {
         echo $_SESSION['not-found'];
         unset($_SESSION['not-found']);
      }
?>

 <table class="tbl-full">
     <tr>  <th>S.No</th>
         <th>Title </th>
         <th>Price </th>
         <th>Image </th>
         <th>Featured</th>
         <th>Active</th>
         <th>Actions</th>

     </tr>
     <?php
     
     $sql="SELECT * FROM tbl_food";
     $res=mysqli_query($conn,$sql);

     $count=mysqli_num_rows($res);
     $sn=1;
     if($count>0){
     while($row=mysqli_fetch_assoc($res)){

        $id=$row['id'];
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
        $featured=$row['featured'];
        $active=$row['active'];
          ?>
          
     <tr>
         <td><?php echo $sn++;?></td>
         <td><?php echo $title;?></td>
         <td><?php echo $price;?></td>
         <td><?php 
            if($image_name!=""){
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?> " width="100px">
                <?php
            }
            else{
               echo  "<div class='error'>Image Not Added</div>";
            }
         echo $image_name;
         
         
         
         ?></td>
         <td><?php echo $featured;?></td>
         <td><?php echo $active;?></td>
         <td>
         <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-secondary">Update Food</a>
         <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
        
         </td>
     </tr>

          <?php


    }
     }
     else{
        echo "<tr> <td colspan='7' class='error'>Food Not Added Yet</td></tr>";
     }



     ?>

     
 </table>
 
</div>
</div>
<?php include('components/footer.php');?>