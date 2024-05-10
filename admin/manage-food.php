<?php include('partials/menu.php'); ?>



<head>

  <script>
    function hideLoginMessage() {
      document.getElementById('admin-food').remove();
    }

    setTimeout(function () {
      hideLoginMessage();
    }, 1500); //1500 millisecondes = 5 secondes
  </script>
  
</head>
<div class="main_content">
    <div class="wrapper">
        <h1 class="title">Manage Food</h1>
        <br /><br/><br/>
        <!--Button to add food-->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary add-btn">Add Food</a>
        <br /><br /><br/>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize'])){
            echo $_SESSION['unauthorize'];
            unset ($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset ($_SESSION['update']);
        }
        ?>

        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price (TND)</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //create sql query to get all the food data
            $sql = "SELECT * FROM tbl_food";
            //execute query 
            $res = mysqli_query($conn, $sql);
            //count rows to check if we have food data 
            $count = mysqli_num_rows($res);

            //create serial variable and initialize it with 1
            $sn=1;

            if ($count > 0) {
                //food data  is database
                //get food data from BD and display
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values from the columns 
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>
                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $price?></td>
                        <td>
                            <?php 
                            //check if we have an image or not
                            if($image_name==""){
                                //we don't have an image => display error mssge 
                                echo "<div class='error'>Image Not Added </div>";
                            }else{
                                //we have image => display it
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width=100px>
                                <?php

                            }
                            
                            ?>


                        </td>
                        <td><?php echo $featured?></td>
                        <td><?php echo $active?></td>
                        <td>
                            <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id?>" class="btn-secondary btns">Update Food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger btns">Delete Food</a>


                        </td>
                    </tr>

                    <?php

                }

            } else {
                //no food data in database 
                echo "<tr>
                    <td colspan='7' class='error'>Food not Added Yet</td>
                    </tr>";
            }

            ?>



        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>