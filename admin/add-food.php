<?php 
//echo"add food page";
include('partials/menu.php');
?>

<div class="main-content update">
    <div class="wrapper ">
        <h1 class="update-title">Add Food</h1>

        <br><br>

        <?php 
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        
        ?>



        <form action="" method="POST" enctype="multipart/form-data" id="formm">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                   <td> <input type="text" name="title" id="food-title" placeholder="Food Title" class="inputt-update" onchange="foodTitle();" ></td>
                   <br><br>
                    <small id="sp-food-title" style="color:red;" ></small>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description"  cols="30" rows="5" placeholder="Food Description" class="inputt-update"></textarea>
                    </td>

                </tr>

                <tr>
                    <td>Price (TND)</td>
                    <td>
                        <input type="number" name="price"  class="inputt-update" placeholder="Price">
                     
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" >

                        <?php 
                          //php code to display categories from BD
                            //1.create sql query to get all active categories from database
                            $sql="SELECT * FROM tbl_category WHERE active='YES'";
                           
                            //execute the query
                            $res=mysqli_query($conn,$sql);

                            //count rows to check if we have categories or not
                            $count=mysqli_num_rows($res);
                           
                           //if count>0 => we have categories elsce we don't
                            if($count >0){
                                //we have categories=>display them
                                while($row=mysqli_fetch_assoc($res)){
                                    //get the details of categories
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php

                                }


                            }else{
                                //don't have categories 
                                ?>
                                <option value="0">No category Is Found</option>
                                <?php

                            }
                           
                           
                            //2.Display in the select 
                        
                        
                        ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>
<?php 
//check if we clicked the button
if(isset($_POST['submit'])){
    //echo "cliked";
    //add food in BD
       //1.get data from the form
       $title=mysqli_real_escape_string($conn,$_POST['title']);
       $description=mysqli_real_escape_string($conn,$_POST['description']);
       $price=mysqli_real_escape_string($conn,$_POST['price']);
       $category=mysqli_real_escape_string($conn,$_POST['category']);
          //check if radio button for featured or active are checked or not
          if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
          }else{
            $featured="No";//mettre une valeur par defaut
          }

          if(isset($_POST['active'])){
            $active=$_POST['active'];
          }else{
            $active="No";//mettre une valeur par defaut
          }

       //2.upload the image if selected
         //check if the select image button is clicked or not.upload the image only if the image is selected
           if(isset($_FILES['image']['name'])){
            //get the details of the selected image
            $image_name=$_FILES['image']['name'];
            
            if($image_name !=""){
                //image is selected

                //A.rename the image
                  //get the extension of the selected image
                    $parts = explode('.', $image_name);                        //va décortiquer l'image par rapport au séparateur '.' et end donnera la derniere partie décortiquée (extension) => ex:jpg
                    $ext = end($parts);

                  //create new name for image
                  $image_name="food_name_".rand(0000,9999).".".$ext;
                 
                //B.upload the image 
                  //get the source path and destination path
                        //source path: current location of the image
                        $src=$_FILES['image']['tmp_name'];
                        //destination path:for the image to be uploaded
                        $dest="../images/food/".$image_name;
                        //upload the food image
                        $upload=move_uploaded_file($src,$dest);
                        //check if the image is uploaded or not
                        if($upload == false){
                            //failed to upload the image 
                            //=> rediect to add food page with error mssge
                            $_SESSION['upload']="<dic id='admin-food' class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop all the process
                            die();
                        }
        
                }

           }else{
            $image_name="";//setting defoult value as blank (image not slected <=>select button uncliked)
           }

       //3.insert in BD
           //create sql query to add all data form in BD
           $sql2="INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price, /*price: valeur numerique =>pas besoin '' */
                image_name='$image_name',
                category_id=$category,
                featured='$featured',   
                active='$active'       
           ";
           //executer la requete
           $res2=mysqli_query($conn,$sql2);
           //check if data inserted or not 
           if($res2==true){
            //data inserted successfully
            $_SESSION['add']="<div id='admin-food' class='success'>Food added Successfully </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            //failed to insert data 
            $_SESSION['add']="<div id='admin-food' class='error'>Failed To Add Food </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
           }

       //4.redirect with mssge to manage-food page


}
?>

    </div>
</div>



<?php include('partials/footer.php');?>