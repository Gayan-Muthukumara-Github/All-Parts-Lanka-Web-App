<?php
include('includes/header.php');
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section">
      <div class="container">
        <?php
          include('messageJT.php');
        ?>
        <div class="row mb-5">
          <form class="col-md-12 form-submit" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Order ID</th>
                    <th class="product-name">Product Name</th>
                    <th class="product-price">Unit Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total Unit Price</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (isset($_SESSION['auth_user'])) {
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $query = "SELECT O.*,P.product_id,P.product_name FROM orderdetails O INNER JOIN product P ON O.product_id = P.product_id WHERE O.user_ID ='$user_id'";
                    $query_run = mysqli_query($con, $query);
                    $grand_total = 0;
                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $uni) {

                  ?>
                        <tr>
                          <td class="product-thumbnail">
                            <h3 class="h6 text-black"><?= $uni['order_ID'] ?></h3>
                          </td>
                          <input type="hidden" class="o_id" value="<?= $uni['order_ID'] ?>">
                          <td class="product-name">
                            <h3 class="h6 text-black"><?= $uni['product_name'] ?></h3>
                          </td>
                          <input type="hidden" class="u_id" value="<?= $uni['product_id'] ?>">
                          <td class="h6">Rs. <?= number_format($uni['price'], 2); ?></td>
                          <input type="hidden" class="price" value="<?= $uni['price'] ?>">
                          <td>
                            <input type="number" class="h6 form-control itemQty" value="<?= $uni['quantity'] ?>" style="width:120px;">
                          </td>
                          <td class="h6">Rs. <?= number_format($uni['total_price'], 2); ?></td>
                          <td><a href="code.php?remove=<?= $uni['order_ID'] ?>" class="btn button-bg1 btn-sm" onclick="return confirm('Are you sure want to remove this item?');">X</a></td>
                        </tr>
                        <?php $grand_total += $uni['total_price']; ?>

                      <?php
                      }
                    } else {
                      ?>
                <tbody>
                  <tr>
                    <td colspan="7">No Record Found</td>
                  </tr>
                </tbody>
            <?php
                    }
                  }
            ?>

            </tbody>
              </table>
            </div>
            <div class="col-md-12">
              <div class="row mb-5">
                <div class="col-md-4">
                  <a class="btn btn-outline-dark btn-block" href="product.php" role="button"><span class="topic-color1">Continue Shopping</span></a>
                </div>
                <div class="col-md-4">
                  <a href="checkout.php?user_id=<?php echo $user_id; ?>" class="btn custom-bg  btn-block <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><span class="text-white">Proceed To Checkout</span></a>
                </div>
                <div class="col-md-4 pl-5">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="h4 text-black">Grand Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <?php
                          if (isset($_SESSION['auth_user'])) {
                          ?>
                            <strong class="h4 text-black">Rs. <?= number_format($grand_total, 2); ?></strong>
                          <?php
                          } else {
                          ?>
                            <strong class="h4 text-black">Rs. 0.00</strong>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

<?php
include('includes/footer.php');
?> 