<?php include('partials/menu.php'); ?>


<script>
    function hideLoginMessage() {
      document.getElementById('admin-order').remove();
    }

    setTimeout(function () {
      hideLoginMessage();
    }, 1500); //1500 millisecondes = 5 secondes
  </script> 


<div class="main_content">
    <div class="wrapper">
        <h1 class="title">Manage Order</h1>


        <br /><br />


        <table class="tbl_full text-center ">
            <tr>
                <th class="text-center ">S.N</th>
                <th class="text-center ">Food</th>
                <th colspan="2" class="text-center ">Price</th>
                <th class="text-center ">Quantity</th>
                <th class="text-center ">Total</th>
                <th class="text-center ">Order Date</th>
                <th class="text-center ">Status</th>
                <th class="text-center ">Customer Name</th>
                <th class="text-center ">Customer Contact</th>
                <th class="text-center ">Email</th>
                <th class="text-center ">Address</th>

                <th>Actions</th>
            </tr>

            <?php
            //get all the orders data from BD
            $sql = "SELECT * FROM tbl_order ORDER BY  id DESC "; //order by desc (order avec facon descendante afin d'afficher les plus récentes ordres au debut )
            //execute query
            $res = mysqli_query($conn, $sql);


            //count the rows 
            $count = mysqli_num_rows($res);
            $sn = 1;


            if ($count > 0) {
                //order data available
                while ($row = mysqli_fetch_assoc($res)) {


                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['quantity'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                    ?>
                    <tr>

                        <td>
                            <?php echo $sn++; ?>
                        </td>
                        <td>
                            <?php echo $food; ?>
                        </td>
                        <td colspan="2">
                            <?php echo $price; ?>
                        </td>
                        <td>
                            <?php echo $qty; ?>
                        </td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                        <td>
                            <?php echo $order_date; ?>
                        </td>


                        <td>

                            <?php

                            //ordered,on delivery,delivered,cancelled
                            if ($status == "Ordered") {
                                echo "<label style='color:blue;'>$status</label>";

                            } elseif ($status == "on Delivery") {
                                echo "<label style='color:orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color:green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color:red;'>$status</label>";
                            }

                            ?>
                        </td>


                        <td>
                            <?php echo $customer_name; ?>
                        </td>
                        <td>
                            <?php echo $customer_contact; ?>
                        </td>
                        <td>
                            <?php echo $customer_email; ?>
                        </td>
                        <td>
                            <?php echo $customer_address; ?>
                        </td>

                        <td colspan="2">
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"
                                class="btn-secondary btns">Update </a>
                        </td>
                    </tr>



                
                
                <?php

                }

                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            
            } else {
                //order data unavailable
            
                echo "<tr><td> class='error'>Orders are not available</td></tr>";

            }
            ?>




        </table>


    </div>
</div>

<?php include('partials/footer.php'); ?>