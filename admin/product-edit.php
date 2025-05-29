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
            <li class="breadcrumb-item active">Edit - Product</li>
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
                Edit - Product
              </h3>
              <a href="product.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php
                        if (isset($_GET['product_id'])) {
                            $product_id = intval($_GET['product_id']); // Ensuring safe input
                            $query = "SELECT * FROM product WHERE product_id = '$product_id' LIMIT 1";
                            $query_run = mysqli_query($con, $query);

                            if ($row = mysqli_fetch_assoc($query_run)) { // Fetch data once
                        ?>
                                <!-- Hidden Input for Product ID -->
                                <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">

                                <!-- Product Name -->
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" value="<?= htmlspecialchars($row['product_name']) ?>" class="form-control" required>
                                </div>

                                <!-- Product Image Upload & Display -->
                                <div class="form-group">
                                    <label for="product_image">Product Image</label>
                                    <input type="file" name="product_image" class="form-control">
                                    <input type="hidden" name="existing_image" value="<?= base64_encode($row['product_image']) ?>">
                                    <br>
                                    <?php if (!empty($row['product_image'])): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" width="100" height="100" alt="Product Image">
                                    <?php else: ?>
                                        <p>No Image Available</p>
                                    <?php endif; ?>
                                </div>

                                <!-- Brand Selection -->
                                <div class="form-group">
                                    <label for="brand_id">Brand</label>
                                    <select name="brand_id" class="form-control" required>
                                        <?php
                                        $brand_query = "SELECT * FROM brand";
                                        $brand_query_run = mysqli_query($con, $brand_query);

                                        while ($brand = mysqli_fetch_assoc($brand_query_run)) {
                                            $selected = ($brand['brand_id'] == $row['brand_id']) ? "selected" : "";
                                            echo "<option value='{$brand['brand_id']}' $selected>{$brand['brand_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Product Type Selection -->
                                <div class="form-group">
                                    <label for="producttype_id">Product Type</label>
                                    <select name="producttype_id" class="form-control" required>
                                        <?php
                                        $producttype_query = "SELECT * FROM producttype";
                                        $producttype_query_run = mysqli_query($con, $producttype_query);

                                        while ($type = mysqli_fetch_assoc($producttype_query_run)) {
                                            $selected = ($type['producttype_id'] == $row['producttype_id']) ? "selected" : "";
                                            echo "<option value='{$type['producttype_id']}' $selected>{$type['producttype_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Dynamic Product Description Fields -->
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <?php
                                    $description = $row['product_description']; // Example: "Size:M;Color:Red;Weight:1.2kg"
                                    if (!empty($description)) {
                                        $description_array = explode(';', $description);
                                        foreach ($description_array as $item) {
                                            if (!empty($item) && strpos($item, ':') !== false) {
                                                list($label, $value) = explode(':', $item);
                                    ?>
                                                <div class="form-group">
                                                    <label for="<?= htmlspecialchars($label) ?>"><?= htmlspecialchars($label) ?></label>
                                                    <input type="text" name="description[<?= htmlspecialchars($label) ?>]" value="<?= htmlspecialchars($value) ?>" class="form-control">
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- Unit Price -->
                                <div class="form-group">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="text" name="unit_price" value="<?= htmlspecialchars($row['unit_price']) ?>" class="form-control" required>
                                </div>

                        <?php
                            } else {
                                echo "<h4>No Record Found!</h4>";
                            }
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="editproduct" class="btn btn-info">Update</button>
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