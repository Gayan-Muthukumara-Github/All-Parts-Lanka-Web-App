<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!--Add User Modal -->
<div class="modal fade" id="AddProductType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <lable for="">Product Type Name</lable>
            <input type="text" name="producttype_name" class="form-control" placeholder="Product Type Name">
          </div>
          <div class="form-group">
            <lable for="">Parameter 1</lable>
            <input type="text" name="parameter1" class="form-control" placeholder="Enter Parameter 1">
          </div>
          <div class="form-group">
            <lable for="">Parameter 2</lable>
            <input type="text" name="parameter2" class="form-control" placeholder="Enter Parameter 2">
          </div>
          <div class="form-group">
            <lable for="">Parameter 3</lable>
            <input type="text" name="parameter3" class="form-control" placeholder="Enter Parameter 3">
          </div>
          <div class="form-group">
            <lable for="">Parameter 4</lable>
            <input type="text" name="parameter4" class="form-control" placeholder="Enter Parameter 4">
          </div>
          <div class="form-group">
            <lable for="">Parameter 5</lable>
            <input type="text" name="parameter5" class="form-control" placeholder="Enter Parameter 5">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addProductType" class="btn btn-primary">Save</button>
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
          <input type="hidden" name="delete_id" class="delete_producttype_id">
          <p>
            Are you sure. you want to delete this data?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="deleteProductType" class="btn btn-primary">Yes, Delete.!</button>
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
                Product Type
                <a href="" data-toggle="modal" data-target="#AddProductType" class="btn btn-primary float-right">Add Product Type</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product Type Name</th>
                    <th>Parameter 1</th>
                    <th>Parameter 2</th>
                    <th>Parameter 3</th>
                    <th>Parameter 4</th>
                    <th>Parameter 5</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $query = "SELECT * FROM producttype";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $pro) {
                  ?>
                      <tr>
                        <td><?= $pro['producttype_name'] ?></td>
                        <td><?= $pro['parameter1'] ?></td>
                        <td><?= $pro['parameter2'] ?></td>
                        <td><?= $pro['parameter3'] ?></td>
                        <td><?= $pro['parameter4'] ?></td>
                        <td><?= $pro['parameter5'] ?></td>
                        <td>
                          <a href="producttype-edit.php?producttype_id=<?php echo $pro['producttype_id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                          <button type="button" value="<?php echo $pro['producttype_id']; ?>" class="btn btn-danger deletebtn">Delete</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="9">No Record Found</td>
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
      $('.delete_producttype_id').val(user_id);
      $('#DeletModal').modal('show');

    });
  });
</script>


<?php include('includes/footer.php'); ?>