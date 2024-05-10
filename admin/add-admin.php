<?php include('partials/menu.php'); ?>


<div class="main-content update">
    <div class="wrapper">
        <h1 class="update-title">Add Admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //display the session message if set 
            unset($_SESSION['add']); //remove session message 
        }
        
        ?>



        <form action="" method="POST" id="formm" >
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name"  id="adminname" placeholder="Enter your name" class="inputt-update"  onchange="chaine();">
                        <br><br>
                        <small id="sp-name" style="color:red;" ></small>
                    </td>
                </tr>

                <tr>
                    <td>UserName</td>
                    <td>
                        <input type="text" name="username" id="adminusername" placeholder=" Your username " class="inputt-update" onchange="chaine2();">
                        <br><br>
                        <small id="sp-username" style="color:red;" ></small>
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" class="inputt-update"  onchange="mdp();" >
                        <br><br>
                        <small id="sp-pass" style="color:red;" ></small>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>

                        <input type="submit" name="submit" value="Add Admin" class="btn-update" >
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>
<?php
//process the value from form and save it to database 
//check whether the submit button  is cliked or not 
if (isset($_POST['submit'])) { //check if the value on submit is passed or not using POST 

    //1.get the data from the form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); //Password encrypted with MD5

    //2.sql query to save the data from the database
    $sql = "INSERT INTO tbl_admin SET
         full_name ='$full_name',
         username='$username',
         password='$password'
        ";
    //3.Execute query and save data in database 

    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    /*mysqli_query is an improved version from mysql.it executes our query.
    execution successful then we move on , if failed , we won't continue other process to stop further process  it's with die and  musqli_error displays error message */

    //4.Check whether query is executed (data is inserted or not) and display an approppriate message 
    if ($res == TRUE) {
        //echo "Data inserted successfully ";

        //create a variable to display message 
        $_SESSION['add'] = "<div id='admin-message' class='success text-center'>Admin Added successfully</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //failed to insert data 
        // echo "Failed to insert data ";
        $_SESSION['add'] = "div id='admin-message' class='error text-center'>Failed To Admin </div>";
        //redirect page 
        header("location" . SITEURL . 'admin/add-admin.php');
    }

}


?>