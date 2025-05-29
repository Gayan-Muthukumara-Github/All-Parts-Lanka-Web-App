<?php
include('includes/header.php');


if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $grand_total = 0;
  $allItems = '';
  $items = [];

  $sql = "SELECT CONCAT(product_id, '(',quantity,')') AS ItemQty, total_price FROM orderdetails";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
  }
  $allItems = implode(', ', $items);
}
?>

<?php

?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container" id="order">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-3  rounded" role="alert">
              <p>Returning customer? <a href="../admin/login.php">Click here</a> to login</p>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-md-6 mb-5 mb-md-0" id="order">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
              <form action="" method="post" id="placeOrder">
                <input type="hidden" name="products" value="<?= $allItems; ?>">
                <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="address" name="address" placeholder="Address" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="district" class="text-black">District<span class="text-danger">*</span></label>
                  <select name="district" id="district" class="form-control" required>
                    <option value="" selected disabled>Distrct</option>
                    <option> Ampara</option>
                    <option> Anuradhapura</option>
                    <option> Badulla</option>
                    <option> Batticaloa</option>
                    <option> Colombo</option>
                    <option> Galle</option>
                    <option> Gampaha</option>
                    <option> Hambantota</option>
                    <option> Jaffna</option>
                    <option> Kalutara</option>
                    <option> Kandy</option>
                    <option> Kegalle</option>
                    <option> Kilinochchi</option>
                    <option> Kurunegala</option>
                    <option> Mannar</option>
                    <option> Matale</option>
                    <option> Matara</option>
                    <option> Moneragala</option>
                    <option> Mullaitivu</option>
                    <option> Nuwara Eliya</option>
                    <option> Polonnaruwa</option>
                    <option> Puttalam</option>
                    <option> Trincomalee</option>
                    <option> Vavuniya</option>
                  </select>
                </div>
                <div class="py-2 mb-3">
                  <label for="due_date" class="text-black">Order Due Date</label><span class="text-danger">*</span></label>
                  <input type="date" class="form-control" name="due_date" required>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" value="Place Order" class="btn custom-bg text-white btn-block">
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Unit Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($_SESSION['auth_user'])) {
                        $user_id = $_SESSION['auth_user']['user_id'];
                        $query = "SELECT P.product_name,O.price,O.quantity,O.total_price FROM orderdetails O INNER JOIN product P ON O.product_id = P.product_id WHERE O.user_ID ='$user_id' ";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $ord) {
                      ?>
                            <tr>
                              <td><?= $ord['product_name'] ?></td>
                              <td>Rs. <?= number_format($ord['price'], 2); ?></td>
                              <td><strong class="mx-2">x</strong> <?= $ord['quantity'] ?></td>
                              <td>Rs. <?= number_format($ord['total_price'], 2); ?></td>
                            </tr>
                          <?php
                          }
                        } else {
                          ?>
                    <tbody>
                      <tr>

                        <td>No item..</td>
                      </tr>
                    </tbody>
                <?php
                        }
                      }
                ?>
                <tr>
                  <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                  <td></td>
                  <td></td>
                  <td class="text-black font-weight-bold"><strong>Rs. <?= number_format($grand_total, 2) ?></strong></td>
                </tr>
                </tbody>
                  </table>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>

<?php
include('includes/footer.php');
?> 