<?php
include('includes/header.php');
?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop  </strong>/<strong class="text-black">  Single Product</strong></div>
        </div>
      </div>
    </div>

    

    <div class="site-section">
      <div class="container">
        <?php
          include('messageJT.php');
        ?>
        <div class="row">
          <?php

          if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $query = "SELECT * FROM product WHERE product_id ='$product_id' LIMIT 1";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
              foreach ($query_run as $row) {
          ?>

                <div class="col-md-6">
                  <?php echo '<img src="data:image;base64,' . base64_encode($row['product_image']) . '" alt="Image placeholder" class="img-fluid">'; ?>
                </div>
                <div class="col-md-6">
                  <h2 class="text-black"><?php echo $row['product_name'] ?></h2>

                  <!-- Formatting the Product Description -->
                  <?php 
                      $description = $row['product_description']; 
                      $description_items = explode(";", $description); 
                  ?>
                  <ul class="product-description">
                      <?php foreach ($description_items as $item) : ?>
                          <li><i class="icon-check"></i> <?= htmlspecialchars($item) ?></li>
                      <?php endforeach; ?>
                  </ul>
                  <form action="" class="form-submit">
                    <h4 class="text-black">Price: $<span class="unit-price"><?php echo number_format($row['unit_price'], 2); ?></span></h4>
                    <p><strong>Total Price: $<span class="total-price"><?php echo number_format($row['unit_price'], 2); ?></span></strong></p>
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark" id="minus" type="button">&minus;</button>
                            </div>
                            <input type="text" id="u_qty" class="form-control text-center u_qty" value="1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" id="plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="u_id" value="<?= $row['product_id'] ?>">
                    <button class="btn custom-bg btn-block addSingleItemBtn">
                        <i class="icon icon-cart-plus text-white"></i>&nbsp;&nbsp;<span class="text-white">Add to cart</span>
                    </button>
                  </form>

                </div>

          <?php
              }
            } else {
              echo "<h4>No Record Found.!</h4>";
            }
          }

          ?>
        </div>
        
      </div>
    </div>

<?php
include('includes/footer.php');
?> 