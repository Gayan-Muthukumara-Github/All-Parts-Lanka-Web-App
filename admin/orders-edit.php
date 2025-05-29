<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit - Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit - Orders
                            </h3>
                            <a href="orders.php" class="btn btn-danger btn-sm float-right">BACK</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="code.php" method="POST">
                                        <div class="modal-body">
                                            <?php
                                            if (isset($_GET['order_id'])) {
                                                $order_id = $_GET['order_id'];
                                                $query = "SELECT * FROM orders WHERE order_id ='$order_id' LIMIT 1";
                                                $query_run = mysqli_query($con, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $ord) {
                                            ?>
                                                        <input type="hidden" name="order_id" value="<?php echo $ord['order_ID'] ?>">
                                                        <input type="hidden" name="user_id" value="<?php echo $row['user_ID'] ?>">
                                                        <div class="form-group">
                                                            <lable for="">order ID</lable>
                                                            <input type="text" name="order_id" value="<?php echo $ord['order_ID'] ?>" class="form-control" placeholder="Name" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">User ID</lable>
                                                            <input type="text" name="user_ID" value="<?php echo $ord['user_ID'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Order Date</lable>
                                                            <input type="text" name="order_date" value="<?php echo $ord['order_date'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Due Date</lable>
                                                            <input type="text" name="due_date" value="<?php echo $ord['due_date'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Product ID</lable>
                                                            <input type="text" name="product_id" value="<?php echo $ord['product_id'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Quantity</lable>
                                                            <input type="text" name="quantity" value="<?php echo $ord['quantity'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Total Price</lable>
                                                            <input type="text" name="total_price" value="<?php echo $ord['total_price'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">delivery Address</lable>
                                                            <input type="text" name="delivery_address" value="<?php echo $ord['delivery_address'] ?>,<?php echo $ord['district'] ?>" class="form-control" placeholder="Phone Number" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <lable for="">Status</lable>
                                                            <select name="status" class="form-control" value="<?php echo $ord['status'] ?>">
                                                                <option>Pending</option>
                                                                <option>Order Confirmed</option>
                                                                <option>Order Cancelled</option>
                                                                <option>Processing</option>
                                                                <option>Packing</option>
                                                                <option>Delivering</option>
                                                            </select>
                                                        </div>
                                            <?php
                                                    }
                                                } else {
                                                    echo "<h4>No Record Found.!</h4>";
                                                }
                                            }
                                            ?>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="editOrders" class="btn btn-info">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>