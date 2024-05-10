<?php 
echo "Delete Page";

//include constants file 
include('../config/constants.php') ;
//check if the id and image_name is set or not 

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the value and delete
     //echo "get the value and delete ";
     $id=mysqli_real_escape_string($conn,$_GET['id']);
     $image_name=mysqli_real_escape_string($conn,$_GET['image_name']);

     //remove the physical image file 
     if($image_name != ""){
        //image is available =>remove it 
        $path="../images/category/".$image_name;

        //remove the image
        $remove =unlink($path);

        //if failed to remove image then add an error mssge and stop the process
        if($remove ==false ){
            //set the session message
            $_SESSION['remove']="<div  id='admin-category' class='error'>Fail to remove category image</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process 
            die();
        }

     }

     //delete data from database
         //sql query
        $sql="DELETE FROM tbl_category WHERE id=$id ";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //check if the data to delete is deleted successfully from database or not
        
        if ($res ==true){
            //set success mssge and redirect 
            $_SESSION['delete']="<div  id='admin-category' class='success'>Category deleted successfully </div>";
            //redirect to manage-category 
            header('location:'.SITEURL.'admin/manage-category.php');
        }else{
            //set fail mssge and redirect
            $_SESSION['delete']="<div  id='admin-category' class='error'>Failed to delete Category</div>";
            //redirect to manage-category 
            header('location:'.SITEURL.'admin/manage-category.php');
        }

}else{
    //redirect to manage category page 
    header('location:'.SITEURL.'admin/manage-category.php');

}
?>