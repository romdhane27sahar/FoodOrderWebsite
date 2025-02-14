<?php include('partials/menu.php');?>

<?php 
//check if id is set or not
if(isset($_GET['id'])){
    //get all the details 
    $id=$_GET['id'];
    //sql query to get the selected food
    $sql2="SELECT * FROM tbl_food WHERE id=$id";
    //execute the qery 
    $res2=mysqli_query($conn,$sql2);
    //get the query execution result
    $row2=mysqli_fetch_assoc($res2);

    //get the individual values of selected food
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];


}
else{
    //redirect to manage food
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>




<!-------------------------------------------->
<!-- proceder à l'update  -->
<?php 
        if (isset($_POST['submit'])){
            //echo "btn clicked";
            //1.get all the data from the form 
            $id=mysqli_real_escape_string($conn,$_POST['id']);
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $description=mysqli_real_escape_string($conn,$_POST['description']);
            $price=mysqli_real_escape_string($conn,$_POST['price']);
            $current_image=mysqli_real_escape_string($conn,$_POST['current_image']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            $featured=mysqli_real_escape_string($conn,$_POST['featured']);
            $active=mysqli_real_escape_string($conn,$_POST['active']);

            //2.upload the image if selected
                //check if the upload button is clicked or not
                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    //check if the file is available 
                    
                    //Image is available 
                    //A.Uploading new image 
                    if($image_name!=""){
                        //image is available 
                        //rename the image 
                        $parts=explode('.',$image_name);
                        $ext=end($parts);
                        $image_name="Food_Name_".rand(000,999).'.'.$ext;
                        
                        //get the source path and destination path
                        $src_path=$_FILES['image']['tmp_name'];
                        $dest_path="../images/food/".$image_name;

                        //upload the image 
                        $upload=move_uploaded_file($src_path,$dest_path);

                        //check if the image is uploaded or not 
                        if($upload==false){
                            //failed to upload 
                            $_SESSION['upload']="<div class='error'>Failed to upload new image </div>";
                            //redirect to manage-food
                            header('locatio:'.SITEURL.'admin/manage-food.php');
                            //stop the process 
                            die();
                        }

                         //3.remove the immage if new image is uploaded 
                            //B.remove current image if current_image is available
                        if($current_image !=""){
                            //remove the image 
                            $remove_path="../images/food/".$current_image;
                            $remove=unlink($remove_path);

                            //check if the image is removed or not 
                            if ($remove ==false){
                                //failed to remove current image 
                                $_SESSION['remove-failed']="<div class='error'>Failed to remove current iamge </div>";
                                //redirect to manage-food 
                                header('location:'.SITEURL."admin/manage-food.php");
                                //stop the process
                                die();
                            }

                        }
                    
                    }
                    else{
                        $image_name=$current_image;//l'image par defaut si l'image is not selected
                    }
                }else{
                    $image_name=$current_image;//l'image par defaut si button not cliked
                }


           

            //4.update food data in BD
                
                //sql query
                $sql3="UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";
                //execute sql query 
                $res3=mysqli_query($conn,$sql3);

                //check if the query is executed or not 

                if($res3 ==true){
                    //query executed and food data updated
                    $_SESSION['update']="<div id='admin-food' class='success'>Food data updated successfully</div>";
                    
                    header('location:'.SITEURL.'admin/manage-food.php');
                    
                }else{
                    
                    $_SESSION['update']="<div id='admin-food' class='error'>Failed to update food data</div>";
                    
                    header('location:'.SITEURL.'admin/manage-food.php');
                    
                }


        }
        ?>



<div class="main-content update">
    <div class="wrapper">
        <h1 class="update-title">Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data" id="formm">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title"  id="food-title" value="<?php echo $title ?>" class="inputt-update" onchange="foodTitle();">
                        <br><br>
                          <small id="sp-food-title" style="color:red;" ></small>
                    
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description"  cols="35" rows="6" ><?php echo $description ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Price</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>" class="inputt-update">
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if($current_image ==""){
                            //image unavailable
                            echo "<div class='error'>Image is unavailable </div>";
                        }else{
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image?>" width="100px"  alt="<?php $title;?>">
                            <?php
                        }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" >
 
                        <?php
                        
                        //query to get all active categories
                        $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        //execute the query
                        $res=mysqli_query($conn,$sql);

                        //count rows 
                        $count =mysqli_num_rows($res);

                        //check if the categoery iis available or not
                        if ($count>0){
                            //category available
                            while($row=mysqli_fetch_assoc($res)){


                                $category_title=$row['title'];
                                $category_id=$row['id'];

                                // echo "<option value='$category_id'>$category_title</option>";
                                ?>
                                <option <?php if ($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                <?php
                           
                           
                            }
                        }else{
                            //category unavailable
                            echo "<option value='0'>Category is unavailable</option>";
                        }

                        
                        ?>


                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured =="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured =="No"){echo "checked";}?> type="radio" name="featured" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active =="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active =="No"){echo "checked";}?> type="radio" name="active" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value=" Update Food" class="btn-update" >
                    </td>
                </tr>
            </table>
        </form>
        


</div>

<?php include('partials/footer.php');?>