<?php include('partials/menu.php'); ?>



<head>

  <script>
    function hideLoginMessage() {
      document.getElementById('admin-message').remove();
    }

    setTimeout(function () {
      hideLoginMessage();
    }, 1500); //1500 millisecondes = 5 secondes
  </script>
  
</head>

<!--Main Section starts-->
<div class="main_content">
    <div class="wrapper">
   
        <h1 class="title">Manage Admin </h1>
        <br />

       

        <br><br>
        <!--Button to add admin-->
        <a href="add-admin.php" class="add-btn btn-primary">Add Admin</a>
        <br /><br /><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //display session message 
            unset($_SESSION['add']); //removing session message when we refresh ,donc on doit vider la variable 'add' au niveau de la session 
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            unset( $_SESSION['change-pwd']);
        }

        ?>

        <table class="tbl_full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all admins
            $sql = "SELECT * from tbl_admin";

            //Execute the query 
            $res = mysqli_query($conn, $sql);
            /*mysqli_query retoune un objet mysqli_result qui contient les résultats de la requête.*/


            //check whether the queryy is executed or not 
            if ($res == TRUE) { /*un objet mysqli_result sera évalué comme "true" en PHP. il est courant de voir cette condition sous forme de "$res==TRUE" pour des raisons de lisibilité.*/

                //count rows to check whether we have data in  database or not 
                $count = mysqli_num_rows($res); //get number of rows in database
                $sn = 1; //create a variable and assign the value
                /*car dans le cas où je supprime id=4 et j'ai id=5 , le id=5 n'est pas adapté pour etre 4 et meme si je supprime tous les enregistrements de la table , il ne revient pas à 1  lors de l''un nouvel ajout  (car auto increment ), le probleme est resolu alors avec sn */

                //check the num of rows 
                if ($count > 0) { //we have data in database
            
                    while ($rows = mysqli_fetch_assoc($res)) {
                        /*mysqli_fetch_assoc — Récupère une ligne de résultat sous forme de tableau associatif
                        tant que j'ai une ligne suivante dans le tableau associatif des resultats de la requete 
                        use a while loop to get all the data from BD
                        while loop will be run as long as we have data in database */

                        $id = $rows['id']; // 'id' = nom du champs dans BD
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];


                        //display lles valeurs récuperes de la BD dans la table 
                        ?>

                        <tr>
                            <td>
                                <?php echo $sn++; ?>
                            </td>
                            <td>
                                <?php echo $full_name ?>
                            </td>
                            <td>
                                <?php echo $username ?>
                            </td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary btns">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                    class="btn-secondary btns">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                    class="btn-danger btns">Delete Admin</a>
                                <!--ou bien pour le lien : ?php echo SITEURL . "admin/delete-admin.php"; ?-->
                           
                           
                            </td>
                        </tr>

                        <?php

                    }
                } else {
                    //we don't have data in database
                    echo "No data Found ";

                }
            }
            ?>

        </table>


    </div>

</div>
<!--Main Section ends-->

<?php include('partials/footer.php'); ?>