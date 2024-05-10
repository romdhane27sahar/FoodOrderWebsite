<?php include('../config/constants.php'); ?>
<html>

<head>
  <title>Login_Food Order System</title>
  <link rel="stylesheet" href="../css/admin.css">
  <!-- font-awsome pour les icones -->
  <link rel="stylesheet" href="../css/font-awsome/css/all.min.css">

  <head>

<script>
  function hideLoginMessage() {
    document.getElementById('login-check-message').remove();
  }

  setTimeout(function () {
    hideLoginMessage();
  }, 1900); 
  
</script>

</head>

</head>

<body>

      <div class="login" >

          <h1 class="text-center">Login</h1>
          
          <br><br>

          <?php
          if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }

          if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
          }
          ?>


          <!--  Login form start -->
          <form action="" method="POST" class="text-center" >

            <div class="input-wrapper">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Enter Username" class="inputt">
            </div>

            <br><br>

            <div class="input-wrapper">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Enter Password" class="inputt">
              <br><br>
              <small id="pass" style="color:red;" ></small>
            </div>

            <br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary inputt">
            

        </form>
        <!-- Login form end  -->

        <br>
        <p class="text-center">Created By - <a href="#">Sahar Romdhane</a></p>
  </div>

</body>

</html>
<?php
//check if the submit button is clicked 
if (isset($_POST['submit'])) {

  //process login 
  // 1.get data from the login form

  //    $username =$_POST['username'] ;

  //======> protection contre SQL injection (coté securité du website)

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = md5($_POST['password']); //le mot de passe est déjà crypté alors il est déjà sécurisé 

  //=======

  // 2.sql query to check if the user with these username and password exist or not in database
  $sql = "SELECT * FROM tbl_admin WHERE username ='$username' AND password='$password'";

  //3.Execute the sql query
  $res = mysqli_query($conn, $sql);

  //4.count rows to check if the user exists or not

  $count = mysqli_num_rows($res);
  if ($count == 1) {
    //user found => login success
    $_SESSION['login'] = "<div id='login-message' class='success'>Logged Successfully </div>";
    //check if the user is logged in or not  
    $_SESSION['user'] = $username; //$_SESSION['user'] won't be unset in index.php , logout will unset it once the session is destroyed(in logout.php)

    //redirect to home page (Dashboard)
    header('location:' . SITEURL . 'admin/index.php');


  } else {
    //the user does not exist  =>login fail
    $_SESSION['login'] = "<div id='login-message' class='error text-center'>Login Failed :check your password or username</div><br>";
    //redirect to home page (Dashboard)
    header('location:' . SITEURL . 'admin/login.php');
  }

}
?>