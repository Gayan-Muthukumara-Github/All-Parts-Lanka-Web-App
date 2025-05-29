<?php
include('includes/header.php');
?>

        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">My Orders</strong></div>
                </div>
            </div>
        </div>




        <div class="container py-lg-5">
            <h3 class="hny-title text-center mb-0 topic-color1">My<span class="topic-color"> Orders</span></h3>
            <p class="mb-2 text-center">What shoud you do</p>

        </div>


        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">



                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Delivery Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['auth_user'])) {
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $query = "SELECT O.order_ID,O.order_date,O.quantity,O.total_price,O.delivery_address,P.product_name FROM orders O
                                                inner join product P ON P.product_id = O.product_id
                                                WHERE user_ID = $user_id";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $pro) {
                                ?>
                                            <tr>
                                                <td><?= $pro['order_ID'] ?></td>
                                                <td><?= $pro['order_date'] ?></td>
                                                <td><?= $pro['product_name'] ?></td>
                                                <td><?= $pro['quantity'] ?></td>
                                                <td><?= $pro['total_price'] ?></td>
                                                <td><?= $pro['delivery_address'] ?>,<?= $pro['district'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">No Record Found</td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>

<?php
include('includes/footer.php');
?> 