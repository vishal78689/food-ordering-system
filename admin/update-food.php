<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
    <h1> Update Food</h1>
    <br/><br/>

    <?php
     if(isset($_GET['id'])){
         $id=$_GET['id'];
         $sql2="SELECT * FROM tbl_food WHERE id=$id";
         $res2=mysqli_query($conn,$sql2);

         
          
           $count1=mysqli_num_rows($res2);
          
            if($count1==1){
                  $rows=mysqli_fetch_assoc($res2);
                 
                  $title=$rows['title'];
                  $current_image=$rows['image_name'];
                  $featured=$rows['featured'];
                  $active=$rows['active'];
                  $price=$rows['price'];
                  $description=$rows['description'];
                  $current_category=$rows['category_id'];




           }
            else{
                $_SESSION['not-found']="<div class='error'> Not Found</div>";
                header('location:'.SITEURL.'admin/food-manage.php');
              
            }
            
            
          
          
          
     }
     else{
         header('location:'.SITEURL.'admin/food-manage.php');
     }

?>
    <form action="" method="POST" enctype="multipart/form-data"> 
    <table class="tbl-30">
  <tr>
      <td>Title</td>
      <td><input type="text" name="title" value="<?php echo $title;?> " /></td>
  </tr>
  <tr>
      <td>Description</td>
      <td><textarea name="description" cols='30' rows='5'> <?php echo $description;?>  </textarea></td>
  </tr>
  <tr>
      <td>Price</td>
      <td><input type="number" name="price" value="<?php echo $price;?>" /></td>
  </tr>
  <tr>
      <td>Current Image</td>
      <td><?php
        if($current_image!=""){
            ?>

         <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image?> " width="150px"/>

            <?php

        }
        else{

           echo  "<div class='error'>Image Not Added</div>";

        }
      ?></td>
  </tr>

  
  <tr>
      <td>New Image</td>
      <td><input type="file" name="image"/></td>
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
               $category_id=$row['id'];
               $category_title=$row['title'];
               ?>
         <option <?php if($current_category==$category_id) echo"selected";?>
          value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
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
      <td><input
     <?php  if($featured=="Yes") {echo "checked";}?>
      type="radio" name="featured" value="Yes"/>Yes
      <input
      <?php if($featured=="No") {echo "checked";}?>
      type="radio" name="featured" value="No"/>No</td>
  </tr>
  <tr>
      <td>Active</td>
      <td><input 
      <?php if($active=="Yes") {echo "checked";}?>
      type="radio" name="active" value="Yes"/>Yes
      <input
      <?php if($active=="No") {echo "checked";}?>
      type="radio" name="active" value="No"/>No</td>
  </tr>
  
 
  <tr>
      <td colspan="2">
          <input type="hidden" name="current_image" value="<?php echo $current_image;?>"/>
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <input type="submit" name="submit" value="Update Food" clas="btn-secondary"/>
      </td>
  </tr>
   </table>
</form>
<?php
 if(isset($_POST['submit']))
 {
      
      $id=$_POST['id'];
      $title=$_POST['title'];
      $description=$_POST['description'];
      $price=$_POST['price'];
     $current_image=$_POST['current_image'];
     $category=$_POST['cat'];
      $featured=$_POST['featured'];
      $active=$_POST['active'];

      //updateimage
      if(isset($_FILES['image']['name'])){

       $image_name=$_FILES['image']['name'];
       
       ///
       if($image_name!="")
       {

           $src_path=$_FILES['image']['tmp_name'];

        //food1.jpg
        $ext=end(explode('.',$image_name));
        $image_name="food_name_".rand(000,999).'.'.$ext;

        
        $dest_path="../images/food/".$image_name;
        $upload=move_uploaded_file($src_path,$dest_path);
        //whether uploaded or not
        if($upload==false){
            $_SESSION['upload']="<div class='error'>Failed To upload Image</div>";
            header('location:'.SITEURL.'admin/food-manage.php');
            die();
       }
         if($current_image!=""){
            $remove_path="../images/food/".$current_image;
            $remove=unlink($remove_path);
     
            if($remove_path==false){
             $_SESSION['failed-remove']="<div class='error'>Failed To Remove Current Image</div>";
             header('location:'.SITEURL.'admin/food-manage.php');
                die();
            }
         }
      
    }
       else{
           $image_name=$current_image;
       }
      }
      else{
        $image_name=$current_image;
      }

      //
      $sql3="UPDATE tbl_food SET
      title='$title',
      description='$description',
      price=$price,
    image_name='$image_name',
    category_id='$category',
      featured='$featured',
       active='$active'
       WHERE id=$id  ";

       $res3=mysqli_query($conn,$sql3);
       if($res3==true){
        $_SESSION ['update']="<div class='success'>Food Updated Successfully</div>";
        header('location:'.SITEURL.'admin/food-manage.php') ;
       }
       else{
        $_SESSION ['update']="<div class='error'>Failed To Update Food</div>";
        header('location:'.SITEURL.'admin/food-manage.php') ;
       }
    }

      
    

?>


</div>
</div>
<?php include('components/footer.php');?>