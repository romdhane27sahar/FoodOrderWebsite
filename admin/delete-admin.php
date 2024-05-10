<?php 
//include constants.php file here
include('../config/constants.php');



//1.get the id of the admin to delete :il est déjà affiché dans l'url donc  le recuperer à partir del'url (donc utiliser  get)
 $id=$_GET['id'];

//2.create SQL query to delete admin 
$sql="DELETE FROM tbl_admin WHERE id =$id";

//3.Execute the query
$res=mysqli_query($conn,$sql);

//check wether the query executed successfully or not 
if($res==true){
    //display message :query executed successfully and admin deleted 
      //echo "Admin Deleted ";
      //create session variable to display message 
      $_SESSION['delete']="<div id='admin-message'  class='success'>Admin Deleted Successfully </div>";
      //redirect to manage admin page 
      header('location:'.SITEURL.'admin/manage-admin.php');

}
else{
    //echo "Failed  to delete Admin";
    $_SESSION['delete']="<div id='admin-message' class='error' Failed to delete admin ! </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
//4.rediresct to manage admin page with message (success/error)


?>