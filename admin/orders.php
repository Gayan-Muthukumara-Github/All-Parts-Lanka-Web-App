<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!--Delete order Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" class="delete_order_id">
                    <p>
                        Are you sure. you want to delete this data?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="deleteOrder" class="btn btn-primary">Yes, Delete.!</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete order Model-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Orders
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>User ID</th>
                                        <th>Order Date</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Due Date</th>
                                        <th>Delivery Address</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM orders";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $order['order_ID'] ?></td>
                                                <td><?= $order['user_ID'] ?></td>
                                                <td><?= $order['order_date'] ?></td>
                                                <td><?= $order['product_id'] ?></td>
                                                <td><?= $order['quantity'] ?></td>
                                                <td><?= $order['total_price'] ?></td>
                                                <td><?= $order['due_date'] ?></td>
                                                <td><?= $order['delivery_address'] ?>,<?= $order['district'] ?></td>
                                                <td><?= $order['status'] ?></td>
                                                <td>
                                                    <a href="orders-edit.php?order_id=<?php echo $order['order_ID']; ?>" class="btn btn-success">Edit</a>
                                                </td>
                                                <td>
                                                    <button type="button" value="<?php echo $order['order_ID']; ?>" class="btn btn-danger deletebtn">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="8">No Record Found</td>
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
        </div>
    </section>
</div>
<?php include('includes/script.php'); ?>

<script>
    $(document).ready(function() {
        $('.deletebtn').click(function(e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('.delete_order_id').val(user_id);
            $('#DeletModal').modal('show');

        });
    });
</script>
<?php include('includes/footer.php'); ?>