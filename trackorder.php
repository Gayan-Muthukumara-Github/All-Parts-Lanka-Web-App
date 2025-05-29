<?php
include('includes/header.php');

$statusMessage = ""; // Initialize status message

// Check if form is submitted
if (isset($_POST['track_order'])) {
    $orderID = $_POST['order_ID'];

    // Prevent SQL injection
    $orderID = $con->real_escape_string($orderID);

    // Fetch order status
    $sql = "SELECT status FROM orders WHERE order_ID = '$orderID'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $statusMessage = "<div class='alert alert-info text-center'><strong>Order Status: </strong>" . $row['status'] . "</div>";
    } else {
        $statusMessage = "<div class='alert alert-danger text-center'>No order found with this ID.</div>";
    }
}
?>

<div class="container py-lg-5">
    <h3 class="hny-title text-center mb-0 topic-color1">Track My <span class="topic-color">Order</span></h3>
    <p class="mb-4 text-center">Enter your Order ID to track your order status</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="order_ID" id="order_ID" class="form-control" required placeholder="Enter Your Order ID">
                </div>
                <button type="submit" name="track_order" class="btn custom-bg btn-block text-white">Track Order</button>
            </form>
        </div>
    </div>

    <?php 
    if (!empty($statusMessage)) {
        echo "<div class='mt-4'>$statusMessage</div>";
    }
    ?>
</div>

<?php
include('includes/footer.php');
?> 