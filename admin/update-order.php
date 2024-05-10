<?php
include('partials/menu.php');
?>

<div class="main-content update">
    <div class="wrapper">
        <h1 class="update-title">Update Order</h1>
        <br><br>
<!---------afficher les données à mettre à jour ---------->

        <?php
        //check if id is set 
        if (isset($_GET['id'])) {
            //get the order details
            $id = $_GET['id'];
            //write the select query to get the details 
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            //execute the query 
            $res = mysqli_query($conn, $sql);

            //count rows 
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //data is available 
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['quantity'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];



            } else {
                //detail is unavailable
                //redirect to manage order
                header('location:' . SITEURL . 'admin/manage-order.php');

            }


        } else {
            //redirect to manage order page 
            header(('location:' . SITEURL . 'admin/manage-order.php'));
        }
        ?>


<!---------update ---------->

        <?php
        // check if the update button is clicked 
        if (isset($_POST['submit'])) {
            //echo"cliked";
            //get all the values from form 
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $total = $qty * $price;
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

            //update the values
            $sql2 = "UPDATE tbl_order SET
                quantity=$qty,
                total=$total,
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
             
                WHERE id=$id";


            //execute the query 
            $res2 = mysqli_query($conn, $sql2);
            //check if the update is successfully done
            if ($res == true) {
                //updated
                $_SESSION['update'] = "<div id='admin-order' class='success text-center'>Order Updated Successfully <div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div id='admin-order' class='error text-center'>Failed to Update Order <div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            }


        }
        ?>

        <form action="" method="POST" id="formm">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b>
                            <?php echo $food; ?>
                        </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b>
                            <?php echo $price; ?> DNT
                        </b></td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" class="inputt-update">

                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                echo "selected";
                            } ?>value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {
                                echo "selected";
                            } ?>value="on Delivery">On Delivery
                            </option>
                            <option <?php if ($status == "Delivered") {
                                echo "selected";
                            } ?> value="Delivered">Delivered
                            </option>
                            <option <?php if ($status == "Cancelled") {
                                echo "selected";
                            } ?>value="Cancelled">Cancelled
                            </option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" id="cus-name" value="<?php echo $customer_name; ?>"
                            class="inputt-update" onchange="customerName();">
                        <br><br>
                        <small id="sp-customer" style="color:red;"></small>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" id="tel" value="<?php echo $customer_contact; ?>"
                            class="inputt-update" onchange="phone();">
                        <br><br>
                        <small id="sp-tel" style="color:red;"></small>
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" id="mail" value="<?php echo $customer_email; ?>"class="inputt-update" onchange="testMail();">
                        <br><br>
                        <small id="sp-mail" style="color:red;"></small>
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <br>

                        <input type="submit" name="submit" value="Update Order" class="btn-update">

                    </td>
                </tr>

            </table>
        </form>


    </div>

</div>
<?php
include('partials/footer.php');
?>