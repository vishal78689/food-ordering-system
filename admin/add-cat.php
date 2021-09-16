<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
    <h1> Add Category</h1>
    <br/><br/>
    <?php
        if(isset($_SESSION['add-cat']))
        {
            echo $_SESSION['add-cat'];
            unset($_SESSION['add-cat']);
         }
         if(isset($_SESSION['upload']))
         {
             echo $_SESSION['upload'];
             unset($_SESSION['upload']);
          }
 

        ?>
        <br/>


    
 <form action="" method="POST" enctype="multipart/form-data">  
   <table class="tbl-30">
  <tr>
      <td>Title</td>
      <td><input type="text" name="title" placeholder="Category Title"/></td>
  </tr>
  <tr>
      <td>Select Image</td>
      <td><input type="file" name="image"/></td>
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
          <input type="submit" name="submit" value="Add Category" clas="btn-secondary"/>
      </td>
  </tr>
   </table>


 </form>


 <?php

if(isset($_POST["submit"])){
    // echo "Clicked";
    //get data from form

     $title=$_POST['title'];
     //radio
     if(isset($_POST['featured'])){
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
  
     if(isset($_FILES['image']['name'])){
        $image_name=$_FILES['image']['name'] ; 

        if($image_name!=""){

        
        $src_path=$_FILES['image']['tmp_name'];

        //food1.jpg
        $ext=end(explode('.',$image_name));
        $image_name="food_cat_".rand(000,999).'.'.$ext;

        
        $dest_path="../images/category/".$image_name;
        $upload=move_uploaded_file($src_path,$dest_path);
        //whether uploaded or not
        if($upload==false){
            $_SESSION['upload']="<div class='error'>Failed To upload Image</div>";
            header('location:'.SITEURL.'admin/add-cat.php');
            die();
        }
    }
     }
     else{
        $image_name="";
     }
  
    // print_r($_FILES['image']);
    // die();
  


$sql="INSERT INTO tbl_category SET
title='$title' ,
image_name='$image_name',
featured='$featured',
active='$active'";

//excecute
$res=mysqli_query($conn,$sql) or die(mysqli_error());
 

if($res==true){
    $_SESSION['add-cat']="<div class='success'>Category Added Succesfully</div>";
   
    
    header('location:'.SITEURL.'admin/category-manage.php');

  
}
else{
    $_SESSION['add-cat']="<div class='error'>Failed To Add Category</div>";
    header('location:'.SITEURL.'admin/add-cat.php');
}
}


?>
</div>

</div>


<?php include('components/footer.php');?>