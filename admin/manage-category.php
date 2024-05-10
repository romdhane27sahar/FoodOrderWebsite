<?php include('partials/menu.php'); ?>


<head>

  <script>
    function hideLoginMessage() {
      document.getElementById('admin-category').remove();
    }

    setTimeout(function () {
      hideLoginMessage();
    }, 1500); //1500 millisecondes = 5 secondes
  </script>
  
</head>



<div class="main_content">
    <div class="wrapper">
        <h1 class="title">Manage Category</h1>
        <br /><br/><br/>
        <!--Button to add admin-->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary add-btn">Add Category</a>
        <br /><br /><br/>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
         
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br>

        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Title </th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all categories from DB
            $sql = "SELECT * FROM tbl_category";

            //execute query 
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);
            
            //create serial number variable and assign value 1
            $sn=1;


            //check if we have data in BD
            if ($count > 0) {
                //we have data in DB
                //get data and display
            
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $title?></td>

                        <td>
                            <?php
                            //check if image name is available or not 

                            if($image_name !=""){ 
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" width="100px">
                                <?php

                            }else{
                                //display the mssge
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            
                            ?>
                        </td>


                        <td><?php echo $featured?></td>
                        <td><?php echo $active?></td>

                        <td>
                        <a href="<?php echo SITEURL?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary btns">Update Category</a>
                        <a href="<?php echo SITEURL?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger btns">Delete Category</a>

                        </td>
                    </tr>
                    <?php
                }

            } else {
                //we don't have data
                //display the mssge inside the table 
                ?>
                <tr>
                    <td>
                        <div colspan="6" class="error">No category added</div>

                    </td>
                </tr>

                <?php

            }

            ?>



        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>