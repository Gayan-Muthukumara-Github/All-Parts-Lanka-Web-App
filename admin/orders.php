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
                            <form method="GET" class="mb-3">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="from_date">From Date</label>
                                        <input type="date" id="from_date" name="from_date" class="form-control" value="<?= isset($_GET['from_date']) ? htmlspecialchars($_GET['from_date']) : '' ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="to_date">To Date</label>
                                        <input type="date" id="to_date" name="to_date" class="form-control" value="<?= isset($_GET['to_date']) ? htmlspecialchars($_GET['to_date']) : '' ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="status">Status</label>
                                        <input type="text" id="status" name="status" class="form-control" placeholder="e.g. Pending" value="<?= isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '' ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="user_id">User ID</label>
                                        <input type="number" id="user_id" name="user_id" class="form-control" value="<?= isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : '' ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="product_id">Product ID</label>
                                        <input type="number" id="product_id" name="product_id" class="form-control" value="<?= isset($_GET['product_id']) ? htmlspecialchars($_GET['product_id']) : '' ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-2">
                                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <a href="orders.php" class="btn btn-secondary btn-block">Clear Filters</a>
                                    </div>
                                </div>
                            </form>

                            <input type="text" id="searchOrders" class="form-control mb-3" placeholder="Search within results...">
                            <table class="table table-bordered" id="ordersTable">
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

                                    // Build dynamic query with optional filters
                                    $query = "SELECT * FROM orders WHERE 1=1";
                                    $params = [];
                                    $types = '';

                                    if (isset($_GET['from_date']) && $_GET['from_date'] !== '') {
                                        $query .= " AND order_date >= ?";
                                        $params[] = $_GET['from_date'];
                                        $types .= 's';
                                    }
                                    if (isset($_GET['to_date']) && $_GET['to_date'] !== '') {
                                        $query .= " AND order_date <= ?";
                                        $params[] = $_GET['to_date'];
                                        $types .= 's';
                                    }
                                    if (isset($_GET['status']) && $_GET['status'] !== '') {
                                        $query .= " AND status LIKE ?";
                                        $params[] = '%' . $_GET['status'] . '%';
                                        $types .= 's';
                                    }
                                    if (isset($_GET['user_id']) && $_GET['user_id'] !== '') {
                                        $query .= " AND user_ID = ?";
                                        $params[] = (int)$_GET['user_id'];
                                        $types .= 'i';
                                    }
                                    if (isset($_GET['product_id']) && $_GET['product_id'] !== '') {
                                        $query .= " AND product_id = ?";
                                        $params[] = (int)$_GET['product_id'];
                                        $types .= 'i';
                                    }

                                    $stmt = mysqli_prepare($con, $query);
                                    if ($stmt) {
                                        if (!empty($params)) {
                                            mysqli_stmt_bind_param($stmt, $types, ...$params);
                                        }
                                        mysqli_stmt_execute($stmt);
                                        $query_run = mysqli_stmt_get_result($stmt);
                                    } else {
                                        $query_run = false;
                                    }

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

        function attachTableFilter(inputSelector, tableSelector) {
            $(inputSelector).on('keyup', function () {
                const term = $(this).val().toLowerCase();
                $(tableSelector + ' tbody tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(term) !== -1);
                });
            });
        }
        attachTableFilter('#searchOrders', '#ordersTable');
    });
</script>
<?php include('includes/footer.php'); ?>