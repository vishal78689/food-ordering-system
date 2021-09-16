<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
 <h1> Add Food</h1>
 <br/><br/>
 <?php
       if(isset($_SESSION['upload']))
       {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
        }
 ?>


 <form action="" method="POST" enctype='multipart/form-data'>

   <table class="tbl-30">
  <tr>
      <td>Title</td>
      <td><input type="text" name="title" placeholder="Food Item"/></td>
  </tr>
  <tr>
      <td>Description</td>
      <td><textarea name="desc"  cols="30" rows="5" placeholder="Food Description"></textarea></td>
  </tr>
  <tr>
      <td>Price</td>
      <td><input type="number" name="price" /></td>
  </tr>
  <tr>
      <td>Select Image</td>
      <td><input type="file" name="image" /></td>
  </tr>
  <tr>
      <td>Category</td>
      <td><select name="cat">

    <?php
      //from database
       $sql="SELECT * FROM tbl_category WHERE active='Yes'";
       $res=mysqli_query($conn,$sql);
       $count=mysqli_num_rows($res);
       
       if($count>0){
           while($row=mysqli_fetch_assoc($res)){
               $id=$row['id'];
               $title=$row['title'];
               ?>
         <option value="<?php echo $id;?>"><?php echo $title;?></option>
               <?php
           }

       }
       else{
           ?>
         
         <option value="0">No Category Found</option>
       <?php

       }
    ?>
      
        
      </select></td>
  </tr>
  <tr>
      <td>Featured</td>
      <td><input type="radio" name="featured" value="Yes"/>Yes
      <input type="radio" name="featured" value="No"/>No</td>
  </tr>
  <tr>
      <td>Active</td>
      <td><input type="radio" name="active" value="Yes"/>Yes
      <input type="radio" name="active" value="No"/>No</td>
  </tr>
  <tr>
      <td colspan="2">
          <input type="submit" name="submit" value="Add Food " clas="btn-secondary"/>
      </td>
  </tr>
   </table>


 </form>
 <?php
   if(isset($_POST['submit']))
 {  
        $title=$_POST['title'];
       $description=$_POST['desc'];
       $price=$_POST['price'];
       $category=$_POST['cat'];
       if(isset($_POST['featured']))
       {
        $featured=$_POST['featured'] ;  
     }
     else{
        $featured="No";
     }
     if(isset($_POST['active'])){
        $active=$_POST['active'] ;  
     }
     else{
        $active="No";
     }



     if(isset($_FILES['image']['name']))
     {
        $image_name=$_FILES['image']['name'] ; 

        if($image_name!="")
        {

        //food1.jpg
        $ext=end(explode('.',$image_name));
        $image_name="food_name_".rand(0000,9999).'.'.$ext;

        
        $src_path=$_FILES['image']['tmp_name'];
        $dest_path="../images/food/".$image_name;
        $upload=move_uploaded_file($src_path,$dest_path);
        //whether uploaded or not
        if($upload==false)
        {
            $_SESSION['upload']="<div class='error'>Failed To upload Image</div>";
            header('location:'.SITEURL.'admin/add-food.php');
            die();
        }
      }

       }
    
    else{
        $image_name="";
       }



       //insert
    

    $sql2="INSERT INTO tbl_food SET
      title='$title' ,
      description='$description',
      price=$price,
      image_name='$image_name',
      category_id=$category,
      featured='$featured',
     active='$active'";

     //excecute
     $res2=mysqli_query($conn,$sql2) or die(mysqli_error());
 

     if($res2==TRUE){
      $_SESSION['add-food']="<div class='success'>Food Added Succesfully</div>";
        header('location:'.SITEURL.'admin/food-manage.php');
        }
   
     else{
      $_SESSION['add-food']="<div class='error'>Failed To Add Food</div>";
      header('location:'.SITEURL.'admin/food-manage.php');
    }

    
 }


?>

</div>
</div>



<?php include('components/footer.php');?>