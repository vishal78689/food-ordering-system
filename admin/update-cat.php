<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
    <h1> Update Category</h1>
    <br/><br/>

    <?php
     if(isset($_GET['id'])){
         $id=$_GET['id'];
         $sql="SELECT * FROM tbl_category WHERE id=$id";
         $res=mysqli_query($conn,$sql);

         
          
          
          
          
            $count=mysqli_num_rows($res);
          
            if($count==1){
                  $rows=mysqli_fetch_assoc($res);
                  $title=$rows['title'];
                  $current_image=$rows['image_name'];
                  $featured=$rows['featured'];
                  $active=$rows['active'];


           }
            else{
                $_SESSION['cat-not-found']="<div class='error'>Category Not Found</div>";
                header('location:'.SITEURL.'admin/category-manage.php');
              
            }
            
            
          
          
          
     }
     else{
         header('location:'.SITEURL.'admin/category-manage.php');
     }

?>
    <form action="" method="POST" enctype="multipart/form-data"> 
    <table class="tbl-30">
  <tr>
      <td>Title</td>
      <td><input type="text" name="title" value="<?php echo $title?> " /></td>
  </tr>
  <tr>
      <td>Current Image</td>
      <td><?php
        if($current_image!=""){
            ?>

         <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image?> " width="150px"/>

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
          <input type="hidden" name="cur_image" value="<?php echo $current_image;?>"/>
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <input type="submit" name="submit" value="Update Category" clas="btn-secondary"/>
      </td>
  </tr>
   </table>
</form>
<?php
 if(isset($_POST['submit']))
 {
      
      $id=$_GET['id'];
      $title=$_POST['title'];
      $current_image=$_POST['cur_image'];
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
        $image_name="food_cat_".rand(000,999).'.'.$ext;

        
        $dest_path="../images/category/".$image_name;
        $upload=move_uploaded_file($src_path,$dest_path);
        //whether uploaded or not
        if($upload==false){
            $_SESSION['upload']="<div class='error'>Failed To upload Image</div>";
            header('location:'.SITEURL.'admin/category-manage.php');
            die();
       }
         if($current_image!=""){
            $remove_path="../images/category/".$current_image;
            $remove=unlink($remove_path);
     
            if($remove_path==false){
             $_SESSION['failed-remove']="<div class='error'>Failed To Remove Current Image</div>";
             header('location:'.SITEURL.'admin/category-manage.php');
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
      $sql2="UPDATE tbl_category SET
      title='$title',
      image_name='$image_name',
      featured='$featured',
       active='$active'
       WHERE id=$id  ";

       $res2=mysqli_query($conn,$sql2);
       if($res2==true){
        $_SESSION ['update']="<div class='success'>Category Updated Successfully</div>";
        header('location:'.SITEURL.'admin/category-manage.php') ;
       }
       else{
        $_SESSION ['update']="<div class='error'>Failed To Update Category</div>";
        header('location:'.SITEURL.'admin/category-manage.php') ;
       }
    }

      
    

?>


</div>
</div>
<?php include('components/footer.php');?>