<?php
include('includes/header.php');
?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
          <div class="row mb-5">
              <!-- Product Listing Section -->
              <div class="col-md-9 order-2">
                
                  <div class="row mb-5">
                    
                      <?php
                      // Build the query with filters
                      $query = "SELECT P.*, PT.producttype_name, B.brand_name 
                              FROM product P 
                              INNER JOIN producttype PT ON P.producttype_id = PT.producttype_id 
                              INNER JOIN brand B ON B.brand_id = P.brand_id 
                              WHERE 1=1";
                      
                      $params = array();
                      
                      // Price range filter
                      if(isset($_GET['min_price']) && !empty($_GET['min_price'])) {
                          $query .= " AND P.unit_price >= ?";
                          $params[] = $_GET['min_price'];
                      }
                      if(isset($_GET['max_price']) && !empty($_GET['max_price'])) {
                          $query .= " AND P.unit_price <= ?";
                          $params[] = $_GET['max_price'];
                      }
                      
                      // Product type filter
                      if(isset($_GET['product_type']) && !empty($_GET['product_type'])) {
                          $placeholders = str_repeat('?,', count($_GET['product_type']) - 1) . '?';
                          $query .= " AND PT.producttype_name IN ($placeholders)";
                          $params = array_merge($params, $_GET['product_type']);
                      }
                      
                      // Brand filter
                      if(isset($_GET['brand']) && !empty($_GET['brand'])) {
                          $placeholders = str_repeat('?,', count($_GET['brand']) - 1) . '?';
                          $query .= " AND B.brand_name IN ($placeholders)";
                          $params = array_merge($params, $_GET['brand']);
                      }
                      
                      // Product name search
                      if(isset($_GET['product_name']) && !empty($_GET['product_name'])) {
                          $query .= " AND P.product_name LIKE ?";
                          $params[] = '%' . $_GET['product_name'] . '%';
                      }
                      
                      // Prepare and execute the query
                      $stmt = mysqli_prepare($con, $query);
                      if(!empty($params)) {
                          $types = str_repeat('s', count($params));
                          mysqli_stmt_bind_param($stmt, $types, ...$params);
                      }
                      mysqli_stmt_execute($stmt);
                      $query_run = mysqli_stmt_get_result($stmt);

                      if (mysqli_num_rows($query_run) > 0) {
                          while ($pro = mysqli_fetch_assoc($query_run)) {
                              // Calculate discount percentage if applicable
                              $original_price = $pro['unit_price'] ?? 0;
                              $discounted_price = $pro['discounted_price'] ?? 0;
                              $discount = 0;
                              if ($original_price > 0 && $discounted_price > 0) {
                                  $discount = round((($original_price - $discounted_price) / $original_price) * 100);
                              }
                      ?>
                      
                              <div class="col-sm-6 col-lg-4 mb-4">
                              <form action="" class="form-submit">
                                  <div class="product-card">
                                      <div class="product-image-container">
                                          <!-- Discount Badge -->
                                          <?php if ($discount > 0) : ?>
                                              <span class="discount-label">-<?= $discount ?>%</span>
                                          <?php endif; ?>
                                          <!-- Product Image -->
                                          <a href="product-single.php?product_id=<?= $pro['product_id']; ?>">
                                              <?php if (!empty($pro['product_image'])) : ?>
                                                  <img src="data:image/jpeg;base64,<?= base64_encode($pro['product_image']) ?>" class="product-image" alt="Product Image">
                                              <?php else : ?>
                                                  <p>No Image</p>
                                              <?php endif; ?>
                                          </a>
                                      </div>

                                      <!-- Product Info -->
                                      <div class="product-info">
                                          <h4 class="product-title">
                                              <a href="product-single.php?product_id=<?= $pro['product_id']; ?>">
                                                  <?= htmlspecialchars($pro['product_name']) ?>
                                              </a>
                                          </h4>
                                          <p class="unit-price">
                                              <?php if ($discount > 0) : ?>
                                                  <span class="discounted_price">$<?= $discounted_price ?></span>
                                                  <span class="original_price">$<?= $original_price ?></span>
                                              <?php else : ?>
                                                  <span class="original_price">$<?= $original_price ?></span>
                                              <?php endif; ?>
                                          </p>
                                      </div>

                                      <!-- Add to Cart Button -->
                                      <input type="hidden" id="u_qty" class="form-control text-center u_qty" value="1">
                                      <input type="hidden" class="u_id" value="<?= $pro['product_id'] ?>">
                                    <button class="add-to-cart-btn addItemBtn">Add to cart
                                    </button>
                                  </div>
                                  </form>
                              </div>
                              
                      <?php
                          }
                      } else {
                          echo "<p>No Record Found</p>";
                      }
                      ?>
                      
                  </div>
                 
                  <!-- Pagination -->
                  <div class="row">
                      <div class="col-md-12 text-center">
                          <div class="pagination">
                              <ul>
                                  <li><a href="#">&laquo;</a></li>
                                  <li class="active"><span>1</span></li>
                                  <li><a href="#">2</a></li>
                                  <li><a href="#">3</a></li>
                                  <li><a href="#">4</a></li>
                                  <li><a href="#">5</a></li>
                                  <li><a href="#">&raquo;</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Sidebar Filters -->
              <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="filter-box">
                    <h3 class="filter-title">
                        <span class="filter-icon"></span> Filters
                    </h3>

                    <form method="GET" action="">
                        <!-- Price Range Filter -->
                        <div class="filter-section">
                            <div class="filter-header">
                                Price Range
                            </div>
                            <div class="filter-content">
                                <div class="form-group">
                                    <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="<?= isset($_GET['min_price']) ? $_GET['min_price'] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="<?= isset($_GET['max_price']) ? $_GET['max_price'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Product Type Filter -->
                        <div class="filter-section">
                            <div class="filter-header">
                                Product Type
                            </div>
                            <div class="filter-content">
                                <?php
                                $type_query = "SELECT DISTINCT producttype_name FROM producttype ORDER BY producttype_name";
                                $type_result = mysqli_query($con, $type_query);
                                while($type = mysqli_fetch_assoc($type_result)) {
                                    $checked = (isset($_GET['product_type']) && in_array($type['producttype_name'], $_GET['product_type'])) ? 'checked' : '';
                                    echo '<label><input type="checkbox" name="product_type[]" value="'.htmlspecialchars($type['producttype_name']).'" '.$checked.'> '.htmlspecialchars($type['producttype_name']).'</label>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Brand Filter -->
                        <div class="filter-section">
                            <div class="filter-header">
                                Brand
                            </div>
                            <div class="filter-content">
                                <?php
                                $brand_query = "SELECT DISTINCT brand_name FROM brand ORDER BY brand_name";
                                $brand_result = mysqli_query($con, $brand_query);
                                while($brand = mysqli_fetch_assoc($brand_result)) {
                                    $checked = (isset($_GET['brand']) && in_array($brand['brand_name'], $_GET['brand'])) ? 'checked' : '';
                                    echo '<label><input type="checkbox" name="brand[]" value="'.htmlspecialchars($brand['brand_name']).'" '.$checked.'> '.htmlspecialchars($brand['brand_name']).'</label>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Product Name Search -->
                        <div class="filter-section">
                            <div class="filter-header">
                                Product Name
                            </div>
                            <div class="filter-content">
                                <div class="form-group">
                                    <input type="text" name="product_name" class="form-control" placeholder="Search product..." value="<?= isset($_GET['product_name']) ? htmlspecialchars($_GET['product_name']) : '' ?>">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn custom-bg text-white btn-block">Apply Filters</button>
                        <a href="product.php" class="btn btn-secondary btn-block">Clear Filters</a>
                    </form>
                </div>
              </div>

          </div>
      </div>
    </div>


<?php
include('includes/footer.php');
?> 