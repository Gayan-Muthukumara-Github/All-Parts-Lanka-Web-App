<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php include('message.php'); ?>
                    <div class="card">
                    <div class="card-body">
                            <input type="text" id="searchOrderDetails" class="form-control mb-3" placeholder="Search...">
                            <table class="table table-bordered" id="orderDetailsTable">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM orderdetails";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $order) {
                                    ?>
                                            <tr>
                                                <td><?= $order['order_ID'] ?></td>
                                                <td><?= $order['product_id'] ?></td>
                                                <td><?= $order['quantity'] ?></td>
                                                <td><?= $order['total_price'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7">No Record Found</td>
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
<?php include('includes/footer.php'); ?>
<script>
  $(document).ready(function() {
    function attachTableFilter(inputSelector, tableSelector) {
      $(inputSelector).on('keyup', function () {
        const term = $(this).val().toLowerCase();
        $(tableSelector + ' tbody tr').each(function () {
          const rowText = $(this).text().toLowerCase();
          $(this).toggle(rowText.indexOf(term) !== -1);
        });
      });
    }
    attachTableFilter('#searchOrderDetails', '#orderDetailsTable');
  });
</script>