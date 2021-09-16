<?php include('components/menu.php');?>

<div class="main-content">
<div class="wrapper">
 <h1> Manage Category</h1>
 <br/>
 <a href="<?php echo SITEURL;?>admin/add-cat.php" class="btn-primary">Add Category</a> <!-- WE WILL CHANGE-->
<br/><br/><br/>
<?php
        if(isset($_SESSION['add-cat']))
        {
            echo $_SESSION['add-cat'];
            unset($_SESSION['add-cat']);
         }
         if(isset($_SESSION['remove']))
         {
             echo $_SESSION['remove'];
             unset($_SESSION['remove']);
          }
          if(isset($_SESSION['delete']))
          {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
           }
           if(isset($_SESSION['cat-not-found']))
           {
               echo $_SESSION['cat-not-found'];
               unset($_SESSION['cat-not-found']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
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
        ?>
<br/><br/><br/>
 <table class="tbl-full">
     <tr>
         <th>S.N </th>
         <th>Title </th>
         <th>Image </th>
         <th>Feautred</th>
         <th>Active</th>
         <th>Actions</th>
     </tr>
     <?php

      
 $sql="SELECT * FROM tbl_category";
 $res=mysqli_query($conn,$sql);
 if($res==TRUE){
     $count=mysqli_num_rows($res); //rows
     if($count>0){
          $sn=1;

        while($rows=mysqli_fetch_assoc($res)){
            $id=$rows['id'];
            $title=$rows['title'];
            $image_name=$rows['image_name'];

            $featured=$rows['featured'];
            $active=$rows['active'];
            ?>
               <tr>
         <td><?php echo $sn++?></td>
         <td><?php echo $title;?></td>

         <td><?php 
            if($image_name!=""){
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?> " width="100px">
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
         <a href="<?php echo SITEURL;?>admin/update-cat.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
         <a href="<?php echo SITEURL;?>admin/delete-cat.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
         </td>
     </tr>
            <?php

        }
    }
        else{
            ?>
            <tr>
                <td colspan="6" >
                    <div class="error">No Category Added.</div>
                </td>
            </tr>
        
            <?php
        }
    }
        ?>

    
    
 </table>
</div>
</div>
<?php include('components/footer.php');?>