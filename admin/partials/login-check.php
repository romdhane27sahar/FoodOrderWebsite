<?php 

//Authorization - Access Control
//check if the user is logged or not 
if(!isset($_SESSION['user']))//if user session is not set (user not logged in)
{
//redirect to login page with message 
$_SESSION['no-login-message']="<div id='login-check-message' class='error text-center'>Please login to access admin panel</div><br>";

//redirect to login page 
header('location:'.SITEURL.'admin/login.php');
}

?>