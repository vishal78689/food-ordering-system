<?php include('frontend/menu.php');?>

<?php
  if(isset($_GET['category_id'])){
   $category_id=$_GET['category_id'];

   //get title
   $sql="SELECT title FROM tbl_category WHERE id=$category_id";
   $res=mysqli_query($conn,$sql);
   $row=mysqli_fetch_assoc($res);
   $category_title=$row['title'];

  }
  else{
      header('location:'.SITEURL);
  }
  
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="background-image: url(images/sir.jpeg);  background-size: cover;  background-repeat: no-repeat;">
        <div class="container">
            
            <h2 style="color: black;">Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             

            
            <?php
           //get search keyword
          

           $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id " ;


           $res2=mysqli_query($conn,$sql2);
           $count=mysqli_num_rows($res2);

           if($count>0)
           {
             while($rows=mysqli_fetch_assoc($res2)){
                 $id=$rows['id'];
                 $title=$rows['title'];
                 $price=$rows['price'];
                 $description=$rows['description'];
                 $image_name=$rows['image_name'];
                    ?>
                     <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image Not Available</div>";
                      }
                      else{
                        ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" class="img-responsive img-curve">
     
                       <?php
                      }
                   ?>
                
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">Rs <?php echo $price;?></p>
                    <p class="food-detail">
                      <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    

                    <?php
                
                }
           
           }
           else{
                echo "<div class='error'>Food Not Found</div>";
           }


           ?> 

           

            <!-- <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->


        

         

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('frontend/footer.php');?>