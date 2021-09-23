<?php include('config/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar" style="background: black;">
   
   
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/resizelogomvit.jpg" alt="Restaurant Logo" class="img-responsive"  style="border-radius: 50%; padding-top:4px;">
                </a>           
</div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href=" <?php echo SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
        <marquee behavior="scroll" direction="right" scrollamount="20"> <h1 style="color: white;">Sir M Visvesvaraya Institute Of Technology College Canteen </h1></marquee>
    </section>
    <!-- Navbar Section Ends Here -->