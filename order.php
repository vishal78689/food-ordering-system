<?php include('frontend/menu.php');?>
  <?php
   if(isset($_GET['food_id'])){
    $food_id=$_GET['food_id'];
 
    //get title
    $sql="SELECT * FROM tbl_food WHERE id=$food_id";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
    }
    else{
        header('location:'.SITEURL);
    }
 
   }
   else{
       header('location:'.SITEURL);
   }

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search"  style="background-image: url(images/d.jpg);  background-size: cover;  background-repeat: no-repeat;">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" Method="POST"  style="background: black; opacity:0.6; padding:10px; color:white;">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>"/>
                        <p class="food-price"> Rs<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>"/>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vishal Thakur" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">USN</div>
                    <input type="email" name="email" placeholder="E.g. 1MV18CS124" class="input-responsive" required>
                    <div class="order-label">PickUp Time</div>
                    <br>
                    <!-- <label for="appt">Choose a time for PickUp: </label>
                    <br> -->
                   <input type="time" id="appt" name="appt" min="09:00" max="18:00"  placeholder="Choose a time for Pick up"  class="input-responsive" required>
                   <br>
                   
                   <label for="appt">College hours are 9am to 4pm </label>
                    <br>
                    <br>
                    <div class="order-label">Special Instruction</div>
                    <textarea name="address" rows="10" placeholder=" healthy food; Low fat cooking; Retaining the nutrients; Cutting down salt; Herbs; Sandwich suggestions ..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

 <?php
  if(isset($_POST["submit"]))
  {
    
    //get data from form
  
    $food=$_POST['food'];

    $price=$_POST['price'];
    $qty=$_POST['qty'];

    $total=$price* $qty;
    $order_date=date("y-m-d h:i:s");
    $status="ordered";

    $cust_name=$_POST['full-name'];
    $cust_contact=$_POST['contact'];
    $cust_email=$_POST['email'];
    $cust_add=$_POST['address'];

    $sql2="INSERT INTO tbl_order SET
     food='$food',
     price=$price,
     qty=$qty,
     total=$total,
     order_date='$order_date',
     status='$status',
     customer_name='$cust_name',
     customer_contact='$cust_contact',
     customer_email='$cust_email',
     customer_address='$cust_add'";
     

    //  echo $sql2;
     
    $res2=mysqli_query($conn,$sql2);

  if($res2==TRUE){
     $_SESSION['order']="<div class='success'>Order Placed </div>";
     header('location:'.SITEURL);
  }
  else{
    $_SESSION['order']="<div class='error'>Failed To Place Order </div>";
    header('location:'.SITEURL);
  }

}


?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('frontend/footer.php');?>