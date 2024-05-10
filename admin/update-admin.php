<?php include('partials/menu.php');?>

<div class="main-content update ">
    <div class="wrapper">
        <h1 class="update-title">Update Admin</h1>
<br><br>

<!--etapes pour afficher les anciennes valeurs à mettre à jour dans les champs du form-->
<?php 
//1.get the id of selectes admin
$id=$_GET['id'];

//2.create sql query to get the details 
$sql="SELECT * FROM tbl_admin WHERE id=$id";

//3.execute the query
$res=mysqli_query($conn,$sql);

//4.check if the query is executed or not

if ($res==true){
    //check whether the data is available or not
    $count=mysqli_num_rows($res);
    //check wether we have data admin data or not 
    if ($count ==1){
        //get the details
       // echo "admin available";
       $row=mysqli_fetch_assoc($res);
       $full_name=$row['full_name'];
       $username=$row['username'];


    }else{
        //redirect to manage-admin page
        header('location:'.SITEURL."admin/manage-admin.php");
    }
}

?>



        <form action="" method="POST" id="formm">
          <table class="tbl-30">
            <tr>
                <td >Full Name</td>
                <td>
                    <input type="text" name="full_name" id="adminname" value="<?php echo $full_name?>" class="inputt-update" onchange="chaine();">
                    <br><br>
                    <small id="sp-name" style="color:red;" ></small>
                </td>
                
            </tr>

            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username" id="adminusername" value="<?php echo $username?>" class="inputt-update" onchange="chaine2();">
                    <br><br>
                    <small id="sp-username" style="color:red;" ></small>
                
                </td>
            </tr>

            <tr>
                <td colspan="2"><!--car chaque ligne contient 2 colonnes donc on veut fusionner 2 colonnes  -->
                <br>
                    <input type="hidden" name="id" value="<?php echo $id;?>" >
                   <input type="submit" name="submit" value="Update Admin" class="btn-update" >
                </td>
            </tr>
          </table>

        </form>

    </div>
</div>

<?php 
//check wether the submit button is clicked or not
if(isset($_POST['submit'])){// tester si la clé submit existe dans le tableau $_POST(si clé existe alors sa valeur existe , la clé submit n'existe que si btn cliqué sinon la clé n'exite pas et donc de meme pour sa valeur )
    //echo "button clicked";
    //recuperer toutes les donnnées du form pour les mettre à jour
    $id=mysqli_real_escape_string($conn,$_POST['id']);
    $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);

    //create sql query to update admin
    $sql="UPDATE tbl_admin SET 
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";

    //execute the query 
    $res=mysqli_query($conn,$sql);

    //check  if the query is executed successfully or not 
    if($res==true){
        //query executed successfully and admin updated
         $_SESSION['update']="<div id='admin-message' class='success'>Admin updated successfully </div>";
         //redirect to manage-admin page 
         header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        //failed to update admin
        $_SESSION['update']="<div id='admin-message' class='error'>Failed to update admin </div>";
        //redirect to manage-admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>
<?php include('partials/footer.php');?>
