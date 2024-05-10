<?php include('partials-front/menu.php'); ?>
<?php
//check if food id is set
if (isset($_GET['food_id'])) {
    //get the food id and ddetails of the selected food
    $food_id = $_GET['food_id'];

    //get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //execute the query 
    $res = mysqli_query($conn, $sql);
    //count the rows 
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //food data is available is database 
        //get the data from database 
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    } else {
        //food is unavailable
        //redirect to home page
        header(('location:' . SITEURL));
    }

} else {
    //redirect to home page
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search order-back">
    <div class="container">

        <h2 class="text-center  order-title">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order" id="formm">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    //check if the image is available 
                    if ($image_name == "") {
                        //image is unavailable
                        echo "<div class='error'>Image is unavailable</div>";
                    } else {
                        //image available
                    
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                            class="img-responsive img-curve">

                        <?php

                    }

                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3>
                        <?php echo $title; ?>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                    </h3>
                    <p class="food-price">
                        <?php echo $price; ?>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                    </p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" id="cus-name" placeholder="E.g. sahar romdhane" class="input-responsive" required onchange="customerName();">
                <small id="sp-customer" style="color:red;"></small>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" id="tel" placeholder="E.g. 9843xxxxxx" class="input-responsive" required onchange="phone();">
            
                <small id="sp-tel" style="color:red;"></small>

                <div class="order-label">Email</div>
                <input type="email" name="email" id="mail" placeholder="E.g. sahar@gmail.com" class="input-responsive" required onchange="testMail();">
            
                        <small id="sp-mail" style="color:red;"></small>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        
        <!-- fonctionnalité d'ajout d'une commande(order) -->
        <?php
        //check if the submit button is clicked 
            if(isset($_POST['submit'])){

                //get all the details from the form
                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];

                $total=$price*$qty; //total to pay = qty * price 

                $order_date=date("Y-m-d h:i:sa");//order date
                $status="Ordered"; //4types of status : ordered ,on delivery ,delivered ,cancelled
                $customer_name=$_POST['full-name'];
                $customer_contact=$_POST['contact'];
                $customer_email=$_POST['email'];
                $customer_address=$_POST['address'];

                //save the order in database
                    //create the sql query 
                        $sql2="INSERT INTO tbl_order SET 
                            food='$food',
                            price=$price,
                            quantity=$qty,
                            total=$total,
                            order_date='$order_date',
                            status ='$status',
                            customer_name='$customer_name',
                            customer_contact='$customer_contact',
                            customer_email='$customer_email',
                            customer_address='$customer_address'

                            ";
                        
                    //execute the query 
                     $res2=mysqli_query($conn,$sql2);

                    //check  if query is executed successfully or not
                    if($res2==true){
                        //query executed and order saved
                        
                        $_SESSION['order']="<br>.<div id='user-order-message' class='success'>Food Ordered Successfully </div>";

                        header('Location:'.SITEURL);
                    }else{
                        //failed to save order
                        $_SESSION['order']="<br>.<div id='user-order-message' class='error'>Failed to Order Food </div>";
                        header('Location:'.SITEURL);

                    }



            }    

        ?>



    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>