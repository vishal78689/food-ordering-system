<?php include('components/menu.php');?>
<div class="main-content">
<div class="wrapper">
 <h1> Manage Order</h1>
 

<br/><br/><br/>
<?php
    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
?>
 <table class="tbl-full">
     <tr>
         <th>S.N </th>
         <th>Food </th>
         <th>Price </th>
         <th>Qty </th>
         <th>Total </th>
         <th>Order Date</th>
         <th>Status </th>
         <th>Customer Name </th>
         <th>Contact</th>
         <th>Email </th>
         <th>Address </th>
         <th>Actions </th>
     </tr>

     <?php

      $sql="SELECT * FROM tbl_order ORDER BY id desc";
      $res=mysqli_query($conn,$sql);
       $count=mysqli_num_rows($res);
       $sn=1;
       if($count>0){
        while($row=mysqli_fetch_assoc($res)){
            $id=$row['id'];
    $food=$row['food'];

    $price=$row['price'];
    $qty=$row['qty'];

    $total=$row['total'];
    $order_date=$row['order_date'];
    $status=$row['status'];
    $cust_name=$row['customer_name'];
    $cust_contact=$row['customer_contact'];
    $cust_email=$row['customer_email'];
    $cust_add=$row['customer_address'];

    ?>
   
   <tr>
         <td><?php echo $sn++;?></td>
         <td> <?php echo $food;?></td>
         <td><?php echo $price;?></td>
         <td> <?php echo $qty;?></td>
         <td> <?php echo $total;?></td>
         <td> <?php echo $order_date;?></td>
           <td>
        <?php

        if($status=="Ordered" or $status=="ordered" ){
            echo "<label>$status</label>";

        }
        else if($status=="Delivered")
          {
            echo "<label style='color:green'>$status</label>";

          }
          else{
            echo "<label style='color:red'>$status</label>";
          }

        ?>

           </td>
  

         <td> <?php echo $cust_name;?></td>
         <td> <?php echo $cust_contact;?></td>
         <td> <?php echo $cust_email;?></td>
         <td> <?php echo $cust_add;?></td>
         <td></td>
         <td>
         <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
         <a href="#" class="btn-danger">Delete Admin</a>
         </td>
     </tr>
    

<?php


        }   

       }
       else{
       echo "<tr><td colspan='12'>No order Yet</td></tr>";

       }
       

   ?>
 </table>
</div>
</div>
<?php include('components/footer.php');?>