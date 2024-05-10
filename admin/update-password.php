<?php include('partials/menu.php'); ?>
<div class="main-content update ">
    <div class="wrapper">
        <h1 class="update-title">Change Password</h1>

        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }


        ?>


        <form action="" method="POST" id="formm">
            <table class="tbl-30">
                <tr>
                    <td>Current Password</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" class="inputt-update">
                    </td>
                </tr>

                <tr>
                    <td>New Password </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" class="inputt-update" onchange="mdp();">
                        <br><br>
                        <small id="sp-pass" style="color:red;" ></small>
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="inputt-update">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <br>
                        <input type="submit" name="submit" value="Change Password" class="btn-update">
                    </td>
                </tr>
            </table>

        </form>



    </div>

</div>

<?php
//check if the submit button is cliked 
if (isset($_POST['submit'])) {
    //echo "clicked "; 

    //1.get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2.check whether the user with current id and password exists or not in database
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' "; //id is int so no need for '', current_password is string so we need ""
    //execute the query
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        //check if data is available 
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user exists and password can be changed
            // echo "user found";

            //check if the new password and confirm-pwrd are matching

            if ($new_password == $confirm_password) {

                //update the password 
                // echo "Password Match";

                $sql2 = "UPDATE tbl_admin SET
                password ='$new_password'
                WHERE id=$id
                ";

                //execute the query 
                $res2 = mysqli_query($conn, $sql2);

                //check if the query executed or not
                if ($res2 == true) {
                    // display success message
                    $_SESSION['change-pwd'] = "<div id='admin-message' class='success'>Password Changed Successfully </div>";
                    // redirect to manage-admin page with success message
                    header('location:'.SITEURL.'admin/manage-admin.php');
                } else {
                    // display error message
                    $_SESSION['change-pwd'] = "<div id='admin-message' class='error'>Failed To Change Password</div>";
                    // redirect to manage-admin page with error message
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                


                
            } else {
                //redirect to manage-admin page with error message
                $_SESSION['pwd-not-match'] = "<div id='admin-message' class='error'>Password did not match</div>";
                //redirect to manage-admin
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        } else {
            //user doesn't exist ==> set message then redirect 
            $_SESSION['user-not-found'] = "<div id='admin-message' class='error'>User Not Found</div>";
            //redirect to manage-admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }



    //3.check if the new password and confirm password match or not

    //4. change password if all above is true
}

?>

<?php include('partials/footer.php'); ?>