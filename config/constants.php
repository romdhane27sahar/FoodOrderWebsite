<?php 

//start session
session_start();
//create constants to store non repeating values
define('SITEURL','http://localhost/food_order/');
define('LOCALHOST','localhost');//define : mot clé pour créer une coste+ une cste doit eter definie en majuscule 
define ('DB_USERNAME','root');
define ('DB_PASSWORD','');
define('DB_NAME','food_order_website');


$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//BD connexion
$db_select=mysqli_select_db($conn,DB_NAME)or die(mysqli_error);//selecting database
?>
 