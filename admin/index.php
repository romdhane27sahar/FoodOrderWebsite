<?php include('partials/menu.php') ?>

<head>

  <script>
    function hideLoginMessage() {
      document.getElementById('login-message').remove();
    }

    setTimeout(function () {
      hideLoginMessage();
    }, 1000); //1000 millisecondes = 5 secondes
  </script>
  
</head>

<!--Main Section starts-->
<div class="main_content">
  <div class="wrapper">
    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    ?>


    <h1 class="title">DASHBOARD</h1>

    <br><br>

    <div class="col-4 text-center card-title">
      <?php
      //calculer le nbre de categories 
      //the qsl query 
      $sql = "SELECT * FROM tbl_category";
      //execute the query 
      $res = mysqli_query($conn, $sql);
      //count rows :c'est le nbre de categories 
      $count = mysqli_num_rows($res);
      ?>
      <h1 class="stat">
        <?php echo $count; ?>
      </h1>
      <br>
      Categories
    </div>


    <div class="col-4 text-center card-title">

      <?php
      //calculer le food
      //the sql query 
      $sql2 = "SELECT * FROM tbl_food";
      //execute the query 
      $res2 = mysqli_query($conn, $sql2);
      //count rows 
      $count2 = mysqli_num_rows($res2);
      ?>
      <h1 class="stat">
        <?php echo $count2; ?>
      </h1>
      <br>
      Food
    </div>

    <div class="col-4 text-center card-title">

      <?php
      //calculer le food
      //the sql query 
      $sql3 = "SELECT * FROM tbl_order";
      //execute the query 
      $res3 = mysqli_query($conn, $sql3);
      //count rows 
      $count3 = mysqli_num_rows($res3);
      ?>
      <h1 class="stat">
        <?php echo $count3; ?>
      </h1>

      <br>
      Total Orders
    </div>

    <div class="col-4 text-center card-title">
      <!-- calcul total revenue -->
      <?php
      //cretae sql query
      $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

      //execute the sql query 
      $res4 = mysqli_query($conn, $sql4);

      //get the value of "total"(calculée)
      $row4 = mysqli_fetch_assoc($res4);
      $total_revenue = $row4['Total'];



      ?>
      <h1 class="stat">
        <?php echo $total_revenue; ?>
      </h1>
      <br>
      Revenue Generated
    </div>

    <div class="clearfix"></div>
  </div>

</div>
<!--Main Section ends-->

<?php include('partials/footer.php') ?>