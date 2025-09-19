<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!--Add Brand-->
<div class="modal fade" id="AddFabric" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <lable for="">Brand Name</lable>
            <input type="text" name="brand_name" class="form-control" placeholder="Brand Type">
          </div>
          <div class="form-group">
            <lable for="">Brand Image</lable>
            <input type="file" name="image" id="image" class="form-control btn-sm">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addBrand" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Delete Brand-->
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
          <input type="hidden" name="brand_id" class="delete_brand">
          <p>
            Are you sure. you want to delete this data?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="deletebrand" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
                                Brand
                                <a href="brand-add.php" data-toggle="modal" data-target="#AddFabric" class="btn btn-primary float-right">Add Brand</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <input type="text" id="searchBrands" class="form-control mb-3" placeholder="Type brand name to filter...">
                            <table class="table table-bordered" id="brandsTable">
                                <thead>
                                    <tr>
                                        <th>Brand ID</th>
                                        <th>Brand Name</th>
                                        <th>Brand Image</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM brand";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $brand) {
                                    ?>
                                            <tr>
                                                <td><?= $brand['brand_id'] ?></td>
                                                <td><?= $brand['brand_name'] ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($brand['brand_image'])) {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($brand['brand_image']) . '" width="100" height="100"/>';
                                                    } else {
                                                        echo "No Image";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                  <a href="brand-edit.php?brand_id=<?php echo $brand['brand_id']; ?>" class="btn btn-success">Edit</a>
                                                </td>
                                                <td>
                                                  <button type="button" value="<?php echo $brand['brand_id']; ?>" class="btn btn-danger deletebtn">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
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

      var f_type = $(this).val();
      $('.delete_brand').val(f_type);
      $('#DeletModal').modal('show');

    });

    // Filter only by Brand Name (2nd column) as user types
    function filterByBrandName() {
      const term = $('#searchBrands').val().toLowerCase();
      $('#brandsTable tbody tr').each(function () {
        const brandName = $(this).find('td:nth-child(2)').text().toLowerCase();
        $(this).toggle(brandName.indexOf(term) !== -1);
      });
    }
    $('#searchBrands').on('keyup', filterByBrandName);
    filterByBrandName();
  });
</script>
<?php include('includes/footer.php'); ?>