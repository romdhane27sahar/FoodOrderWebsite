<?php include('partials/menu.php'); ?>


<div class="main-content update">
    <div class="wrapper">
        <h1 class="update-title">Update Category</h1>

        <br><br>

        <?php
        //check if the id is set or not 
        if (isset($_GET['id'])) {


            //get the id and all other details
        
            // echo "getting the data";
            $id = $_GET['id'];


            //create sql query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id= $id";
            //execute the query 
            $res = mysqli_query($conn, $sql);

            //count the rows to check if the id is valid or not 
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else {
                //redirect to manage category with session mssge 
                $_SESSION['no-category-found'] = "<div  id='admin-category' class='error'>Category Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }

        } else {
            //redirect to manage category 
            header(('location:' . SITEURL . 'admin/manage-category.php'));
        }

        ?>



        <form action="" method="POST" enctype="multipart/form-data" id="formm">
            <table class="tbl-30">
                <tr>
                    <td>Title </td>
                    <td>
                        <input type="text" name="title" id="cat-title" value="<?php echo $title; ?>" class="inputt-update" onchange="categTitle();">
                        <br><br>
                        <small id="sp-category" style="color:red;" ></small>
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td >
                        <?php
                        if ($current_image != "") {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        } else {
                            //display mssge
                            echo "<div class='error'>Image Not Added</div>";
                        }
                        ?>
                    </td>
                </tr>


                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if ($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes" >Yes
                        <input <?php if ($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if ($active == "Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {echo "checked";}?> type="radio" name="active" value="No">No


                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <br>

                        <input type="submit" name="submit" value="Update Category"  class="btn-update">
                    </td>
                </tr>

            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            // echo "clicked";
            //1.get all the values from the form
            $id = mysqli_real_escape_string($conn,$_POST['id']);
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $current_image = mysqli_real_escape_string($conn,$_POST['current_image']);
            $featured = mysqli_real_escape_string($conn, $_POST['featured']);
            $active = mysqli_real_escape_string($conn,$_POST['active']);

            //2.update new image if selected
        
            //check if the image is selected or not
            if (isset($_FILES['image']['name'])) {
                //get the image details
                $image_name = $_FILES['image']['name'];
                //check if the image is available or not
                if ($image_name != "") {
                    //image availalble
        
                    //A.upload the new image
                    //auto rename the image(si on upload une image avec le meme nom , la 1ere ne sera pas écrasée mais renommée, avec l'auto rename , chaque uploaded image sera renommée automatiquement donc aura un nom unique  )
                    //1.get the extension of the image(jpg,png,gif,..)ex:"specialFood.jpg"
                    $parts = explode('.', $image_name);
                    $ext = end($parts);

                    //2.rename the image
                    $image_name = "food_category_" . rand(000, 999) . '.' . $ext; //ex: "food_category_384.jpg"
        
                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check if the image is uploaded or not
                    //if image not uploades => stop the process and redirectwith error mssge
                    
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div  id='admin-category' class='error'>Failed to upload image !</div>";
                        //redirect to add-category page
                        header('location' . SITEURL . "admin/manage-category.php");
                        //stop the process (so that the image won't be uploaded to BD)
                        die();
                    }
                    //B.remove the current image if available

                    if($current_image !=""){
                        $remove_path = "../images/category/".$current_image;
                    
                        $remove = unlink($remove_path);
    
                        //check if the image is removed or not
                        //if failed to remove =>display mssge and stop the process
                        if($remove == false){
                        $_SESSION['failed-remove'] = "<div  id='admin-category' class='error'>Failed to remove current message </div>";
                        header('location' . SITEURL . "admin/manage-category.php");
                        die();
                    }
                    }
                    

                } else {
                    $image_name = $current_image;

                }
            } else {
                $image_name = $current_image;
            }


            //3.update the database
            $sql2 = "UPDATE tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                        ";

            //execute the query 
            $res2 = mysqli_query($conn, $sql2);


            //4.redirect to manage category with mssge
            //check if executed or not
            if ($res2 == true) {
                //category updated 
                $_SESSION['update'] = "<div  id='admin-category' class='success'>Category updated successfully</div>";
                //redirect to manage-category page
                header('location:' . SITEURL . "admin/manage-category.php");

            } else {
                //failed to update
                $_SESSION['update'] = "<div  id='admin-category' class='error'>Failed To Update Category </div>";
                //redirect to manage-category page
                header('location:' . SITEURL . "admin/manage-category.php");

            }

        }


        ?>
    </div>

</div>

<?php include('partials/footer.php'); ?>