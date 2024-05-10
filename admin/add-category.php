<?php include('partials/menu.php'); ?>

<div class="main-content update">
    <div class="wrapper">
        <h1 class="update-title">Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>


        <!-- Add Category starts -->
        <form action="" method="POST" enctype="multipart/form-data" id="formm">
            <!--enctype="multipart/form-data" will allow to import an image file -->
            <table class="tbl-30">
                <tr>
                    <td><label >Title </label></td>
                    <td><input type="text" name="title" id="cat-title" placeholder="Category Title" class="inputt-update" onchange="categTitle();"></td>
                    <br><br>
                    <small id="sp-category" style="color:red;" ></small>
                </tr>

                <tr>
                    <td><label>Featured</label></td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td><label >Active</label></td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Category" class="btn-update">
                    </td>
                </tr>


            </table>
        </form>
        <!-- Add Category ends -->


        <?php
        //check if the submit buttom is clicked
        if (isset($_POST['submit'])) {
            //echo "clicked";
        
            //1.get the values from the category form
        
            $title = $_POST['title'];
            //for input type radio we have to check if the button is selected or not
            if (isset($_POST['featured'])) {
                //get the value from the form
                $featured = $_POST['featured'];
            } else {
                //mettre une valeur par defaut
                $featured = "No";

            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //for the image:check if the image is selected or not and set the value for image accordingly
        
          //print_r($_FILES['image']);//echo n'affiche pas les valeur d'un array , print_r le fait 
            //die();//break the code here
        
            if (isset($_FILES['image']['name'])) {
                //upload the image
                //=> to upload image we need :image-name,source path and destination path
                
                $image_name = $_FILES['image']['name'];

                //upload image only if image is selected
        
                if ($image_name != "") {

                        //auto rename the image(si on upload une image avec le meme nom , la 1ere ne sera pas écrasée mais renommée, avec l'auto rename , chaque uploaded image sera renommée automatiquement donc aura un nom unique  )
                        //1.get the extension of the image(jpg,png,gif,..)ex:"specialFood.jpg"
                        $parts = explode('.', $image_name); //va décortiquer l'image par rapport au séparateur '.' et end donnera la derniere partie décortiquée (extension) => ex:jpg
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
                            $_SESSION['upload'] = "<div id='admin-category' class='error'>Failed to upload image !</div>";
                            //redirect to add-category page
                            header('location' . SITEURL . "admin/add-category.php");
                            //stop the process (so that the image won't be uploaded to BD)
                            die();
                        }

                }
            } else {
                //don't upload the image and set the image_name value as blank
                $image_name = "";
            }

            //2.create sql query to insert these values in database
            $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //3.execute the query
            $res = mysqli_query($conn, $sql);
            //4.check if the query is the query is executed successfully and wether the data is added in BD
        
            if ($res == true) {
                //query executed and category added
                $_SESSION['add'] = "<div  id='admin-category' class='success'>Category Added Successfully</div>";
                //redirect to manage-category page 
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //failed to add category 
                $_SESSION['add'] = "<div  id='admin-category' class='error'>Failed To Add Category </div>";
                //redirect to manage-category page 
                header('location:' . SITEURL . 'admin/add-category.php');
            }


        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>