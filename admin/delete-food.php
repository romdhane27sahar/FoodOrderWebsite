<?php 
//echo "delete food page";

//include constants page 
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){ //we can also use 'AND' instead of '&&'
    //process to delete
    //echo "process to delete";

    //1.get the id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //2.remove the image if available
    //check if the image is available and delete it if availlable only

    if ($image_name =""){
        //image availagle =>remove it from images folder
        //get the image path
        $path="../images/food".$image_name;

        //remove image file from folder 
        $remove =unlink($path);

        //check if the image is deleted or not
        if($remove ==false){
            //failed to remove image
            $_SESSION['upload']="<div id='admin-food' class='error'>Failed to remove Image</div>";
            //redirect to manage food 
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process of deleting food data 
            die();
        }
    }

    //3.delete food from database
        $sql="DELETE FROM tbl_food WHERE id=$id";
        //execute the query
        $res=mysqli_query($conn,$sql);

        //check if the query is executed successfully 
        if($res==true){

            //food deleted
            $_SESSION['delete']="<div id='admin-food' class='success'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            $_SESSION['delete']="<div id='admin-food' class='error'>Food deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }


    //4.redirect to manage food with session message

}else{
    //redirect to manage food page 
    //echo "redirect";
    $_SESSION['delete']="<div id='admin-food' class='error'>Unauthorized Access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}

?>