<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
 <h1> Update Order</h1>
  <?php 
     if(isset($_GET['id'])){
         $id=$_GET['id'];
         $sql2="SELECT * FROM tbl_order WHERE id=$id";
         $res2=mysqli_query($conn,$sql2);

         
          
           $count1=mysqli_num_rows($res2);
          
            if($count1==1){
                  $rows=mysqli_fetch_assoc($res2);
                 
                  $food=$rows['food'];
                  $price=$rows['price'];
                  $qty=$rows['qty'];
                  $status=$rows['status'];
                  $customer_name=$rows['customer_name'];
                  $customer_contact=$rows['customer_contact'];
                  $customer_email=$rows['customer_email'];
                  $customer_add=$rows['customer_address'];




           }
           else{
            header('location:'.SITEURL.'admin/order-manage.php');
           }
        }
        else{
            header('location:'.SITEURL.'admin/order-manage.php');
        }
?>
<br/><br/><br/>
<form action="" method="POST">
<table class="tbl-30">
    <tr>
        <td>Food Name</td>
        <td><b><?php echo $food?></b></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><b> Rs<?php echo $price?></b></td>
    </tr>

    <tr>
        <td>qty</td>
        <td><input type="number" name="qty" value="<?php echo $qty;?>"/></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <select name="status">
                <option <?php 
                if($status=='Ordered')
                {echo "selected";}?>
                value="Ordered">Ordered</option>
                <option
                <?php 
                if($status=='Delivered')
                {echo "selected";}?> value="Delivered">Delivered</option>
                <option 
                <?php 
                if($status=='Cancelled')
                {echo "selected";}?>
                value="Cancelled">Cancelled</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Customer Name</td>
        <td><input type="text" name="customer_name" value="<?php echo $customer_name;?>"/></td>
    </tr>

    <tr>
        <td>Customer Contact</td>
        <td><input type="text" name="customer_contact" value="<?php echo $customer_contact;?>"/></td>
    </tr>

    <tr>
        <td>Customer Email</td>
        <td><input type="text" name="customer_email" value="<?php echo $customer_email;?>"/></td>
    </tr>
    <tr>
        <td>Customer Address</td>
        <td><textarea name="customer_add" value=""><?php echo $customer_add;?></textarea></td>
    </tr>
    <tr>
 <td colspan="2">
     <input type="hidden" name="id" value="<?php echo $id;?>"/>
     <input type="hidden" name="price" value="<?php echo $price;?>"/>
            <input type="submit" name="submit" value="update order"/>
        </td>
    </tr>
</table>


</form>
<?php
if(isset($_POST['submit']))
{

     $id=$_POST['id'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $total=$price * $qty;
    $status=$_POST['status'];
    $customer_name=$_POST['customer_name'];
    $customer_contact=$_POST['customer_contact'];
    $customer_email=$_POST['customer_email'];
    $customer_add=$_POST['customer_add'];

   $sql="UPDATE tbl_order SET
   qty=$qty,
   total=$total,
   status='$status',
   customer_name='$customer_name',
   customer_contact='$customer_contact',
   customer_email='$customer_email',
   customer_address='$customer_add' 
   WHERE id=$id";
   
//    echo $sql;
//    die();
$res=mysqli_query($conn,$sql);


if($res==true){
    $_SESSION ['update']="<div class='success'>Order Updated Successfully</div>";
    header('location:'.SITEURL.'admin/order-manage.php') ;
}
else
{
    $_SESSION ['update']="<div class='error'>Failed To Update Order</div>";
    header('location:'.SITEURL.'admin/order-manage.php') ;
}
         
          

}
?>


</div>
</div>
<?php include('components/footer.php');?>