<?php

include('../config/constants.php');
include('login-check.php');


?>



<html>

<head>
  <title>Food Order Website _ Home Page</title>
  <link rel="stylesheet" href="../css/admin.css">
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <script src="../JS/fonctions.js"></script>

  <!-- imported font from google fonts  -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ysabeau:ital,wght@1,500;1,700;1,1000&display=swap" rel="stylesheet">







</head>

<body>
  <!--Menu Section starts-->
  <div class="menu text-center ">

    <div class="wrapper">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Food</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>


  <!--Menu Section ends-->