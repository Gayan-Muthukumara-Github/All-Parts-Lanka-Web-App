<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<?php

$query = "SELECT * FROM product";
$query_run = mysqli_query($con, $query);
$product_data = [];

if (mysqli_num_rows($query_run) > 0) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        $product_data[] = $row; // Store all products in an array
    }
}

?>

<!--Add User Modal -->
<div class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <lable for="">Product Name</lable>
            <input type="text" name="product_name" class="form-control" placeholder="Product Type Name">
          </div>
          <div class="form-group">
            <lable for="">Product Image</lable>
            <input type="file" name="product_image" id="product_image" class="form-control btn-sm">
          </div>
          <div class="form-group">
            <label for="">Brand</label>
            <select class="form-control" name="brand_id">
                <?php
                $query = "SELECT brand_id, brand_name FROM brand";
                $query_run = mysqli_query($con, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $cnm) {
                ?>
                        <option value="<?= $cnm['brand_id'] ?>"><?= $cnm['brand_name'] ?></option>
                <?php
                    }
                } else {
                ?>
                    <p>No Record Found</p>
                <?php
                }
                ?>
            </select>
          </div>
          <div class="form-group">
              <label for="">Product Type</label>
              <select class="form-control" id="producttype_id" name="producttype_id">
                  <option value="">Select Product Type</option>
                  <?php
                  $query = "SELECT producttype_id, producttype_name FROM producttype";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $cnm) {
                  ?>
                          <option value="<?= $cnm['producttype_id'] ?>"><?= $cnm['producttype_name'] ?></option>
                  <?php
                      }
                  } else {
                  ?>
                      <p>No Record Found</p>
                  <?php
                  }
                  ?>
              </select>
          </div>
          <div class="form-group">
            <lable for="">Unit Price</lable>
            <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
          </div>
          <div id="parameterFields"></div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addProduct" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Add User Modal -->
<!--Delete User Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Parameter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" class="delete_product_id">
          <p>
            Are you sure. you want to delete this data?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="deleteProduct" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete User Model-->

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
                Product
                <a href="" data-toggle="modal" data-target="#AddProduct" class="btn btn-primary float-right">Add Product</a>
              </h4>
            </div>
            <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Brand</th>
                        <th>Product Description</th>
                        <th>Unit Price</th>
                        <th>Product Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($product_data)): ?>
                        <?php foreach ($product_data as $pro): ?>
                            <tr>
                                <td><?= $pro['product_id'] ?></td>
                                <td><?= $pro['product_name'] ?></td>
                                <td><?= $pro['producttype_id'] ?></td>
                                <td><?= $pro['brand_id'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#descModal-<?php echo $pro['product_id']; ?>">
                                        View Details
                                    </button>
                                    <div class="modal fade" id="descModal-<?php echo $pro['product_id']; ?>" tabindex="-1" aria-labelledby="descModalLabel-<?php echo $pro['product_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="descModalLabel-<?php echo $pro['product_id']; ?>">Product Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Parameter</th>
                                                                <th>Value</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $description = $pro['product_description']; 
                                                            $description_array = explode(';', $description); 
                                                            foreach ($description_array as $item) {
                                                                if (!empty($item)) {
                                                                    list($key, $value) = explode(':', $item); 
                                                                    echo "<tr>
                                                                            <td><strong>$key</strong></td>
                                                                            <td>$value</td>
                                                                          </tr>";
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $pro['unit_price'] ?></td>
                                <td>
                                    <?php if (!empty($pro['product_image'])): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($pro['product_image']) ?>" width="100" height="100" alt="Product Image">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="product-edit.php?product_id=<?php echo $pro['product_id']; ?>" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <button type="button" value="<?php echo $pro['product_id']; ?>" class="btn btn-danger deletebtn">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No Record Found</td>
                        </tr>
                    <?php endif; ?>
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
      $('.delete_product_id').val(user_id);
      $('#DeletModal').modal('show');

    });
  });
</script>

<script>
    $(document).ready(function () {
        $('#producttype_id').change(function () {
            const producttypeId = $(this).val();

            if (producttypeId) {
                $.ajax({
                    url: 'code.php', 
                    method: 'POST',
                    data: { producttype_id: producttypeId },
                    success: function (response) {
                        $('#parameterFields').html(response);
                    },
                    error: function () {
                        alert('Error fetching parameters');
                    }
                });
            } else {
                $('#parameterFields').html(''); 
            }
        });
    });
</script>

<?php include('includes/footer.php'); ?>