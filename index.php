<?php include('partials-front/menu.php'); ?>

<head>

<script>
  function hideLoginMessage() {
    document.getElementById('user-order-message').remove();
  }

  setTimeout(function () {
    hideLoginMessage();
  }, 1900); 
  
</script>

</head>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
    if (isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Food Categories</h2>

        <?php
        //create sql query to display categories from BD
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

        //execute the query 
        $res = mysqli_query($conn, $sql);
        //count rows to check if the category is available
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //categories available
            while ($row = mysqli_fetch_assoc($res)) {
                //get the values (title ,image_name)
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

                ?>
                <a href="<?php echo SITEURL ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <!-- check if image is available  -->
                        <?php
                        if ($image_name == "") {
                            //dispaly message 
                            echo "<div class='error'>Image is unavailable</div>";
                        } else {
                            //image available
                            ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                                class="img-responsive img-curve">

                            <?php
                        }
                        ?>

                        <h3 class="float-text text-white">
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </a>
                <?php


            }
        } else {
            echo "<div class='error'>Category not found !</div>";
            // categories unavailable
        }
        ?>









        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Explore Food Menu</h2>

        <?php
        //getting foods from BD (active +featured ones)
        //sql query 
        $sql2 = "SELECT * FROM  tbl_food WHERE active ='Yes' AND featured='Yes' LIMIT 5 ";

        //execute query
        $res2 = mysqli_query($conn, $sql2);

        //count rows 
        $count2 = mysqli_num_rows($res2);

        //check if food is available 
        if ($count > 0) {
            //food available
            while ($row = mysqli_fetch_assoc($res2)) {
                //get all the values 
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];

                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php

                        //check if image is available 
                        if ($image_name == "") {
                            //image unavailable
                            echo "<div class='error'>Image unavailable</div>";

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
                        <h4>
                            <?php echo $title; ?>
                        </h4>
                        <p class="food-price">
                            <?php echo $price; ?>
                        </p>
                        <p class="food-detail">
                            <?php echo $description; ?>

                        </p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

                <?php
            }
        } else {
            //food data unavailable
            echo "<div class='error'>Food data unavailable</div>";
        }
        ?>





        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">Explore Our Various Categories</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>