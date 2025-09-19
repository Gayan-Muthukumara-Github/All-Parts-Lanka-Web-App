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
          <div class="form-group">
            <lable for="">Parameter 6</lable>
            <input type="text" name="parameter6" class="form-control" placeholder="Enter Parameter 6">
          </div>
          <div class="form-group">
            <lable for="">Parameter 7</lable>
            <input type="text" name="parameter7" class="form-control" placeholder="Enter Parameter 7">
          </div>
          <div class="form-group">
            <lable for="">Parameter 8</lable>
            <input type="text" name="parameter8" class="form-control" placeholder="Enter Parameter 8">
          </div>
          <div class="form-group">
            <lable for="">Parameter 9</lable>
            <input type="text" name="parameter9" class="form-control" placeholder="Enter Parameter 9">
          </div>
          <div class="form-group">
            <lable for="">Parameter 10</lable>
            <input type="text" name="parameter10" class="form-control" placeholder="Enter Parameter 10">
          </div>
          <div class="form-group">
            <lable for="">Parameter 11</lable>
            <input type="text" name="parameter11" class="form-control" placeholder="Enter Parameter 11">
          </div>
          <div class="form-group">
            <lable for="">Parameter 12</lable>
            <input type="text" name="parameter12" class="form-control" placeholder="Enter Parameter 12">
          </div>
          <div class="form-group">
            <lable for="">Parameter 13</lable>
            <input type="text" name="parameter13" class="form-control" placeholder="Enter Parameter 13">
          </div>
          <div class="form-group">
            <lable for="">Parameter 14</lable>
            <input type="text" name="parameter14" class="form-control" placeholder="Enter Parameter 14">
          </div>
          <div class="form-group">
            <lable for="">Parameter 15</lable>
            <input type="text" name="parameter15" class="form-control" placeholder="Enter Parameter 15">
          </div>
          <div class="form-group">
            <lable for="">Parameter 16</lable>
            <input type="text" name="parameter16" class="form-control" placeholder="Enter Parameter 16">
          </div>
          <div class="form-group">
            <lable for="">Parameter 17</lable>
            <input type="text" name="parameter17" class="form-control" placeholder="Enter Parameter 17">
          </div>
          <div class="form-group">
            <lable for="">Parameter 18</lable>
            <input type="text" name="parameter18" class="form-control" placeholder="Enter Parameter 18">
          </div>
          <div class="form-group">
            <lable for="">Parameter 19</lable>
            <input type="text" name="parameter19" class="form-control" placeholder="Enter Parameter 19">
          </div>
          <div class="form-group">
            <lable for="">Parameter 20</lable>
            <input type="text" name="parameter20" class="form-control" placeholder="Enter Parameter 20">
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
              <input type="text" id="searchProductTypes" class="form-control mb-3" placeholder="Type product type name to filter...">
              <div class="table-responsive">
              <table class="table table-bordered" id="productTypesTable" style="white-space: nowrap;">
                <thead>
                  <tr>
                    <th>Product Type Name</th>
                    <th>Parameter 1</th>
                    <th>Parameter 2</th>
                    <th>Parameter 3</th>
                    <th>Parameter 4</th>
                    <th>Parameter 5</th>
                    <th>Parameter 6</th>
                    <th>Parameter 7</th>
                    <th>Parameter 8</th>
                    <th>Parameter 9</th>
                    <th>Parameter 10</th>
                    <th>Parameter 11</th>
                    <th>Parameter 12</th>
                    <th>Parameter 13</th>
                    <th>Parameter 14</th>
                    <th>Parameter 15</th>
                    <th>Parameter 16</th>
                    <th>Parameter 17</th>
                    <th>Parameter 18</th>
                    <th>Parameter 19</th>
                    <th>Parameter 20</th>
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
                        <td><?= $pro['parameter6'] ?></td>
                        <td><?= $pro['parameter7'] ?></td>
                        <td><?= $pro['parameter8'] ?></td>
                        <td><?= $pro['parameter9'] ?></td>
                        <td><?= $pro['parameter10'] ?></td>
                        <td><?= $pro['parameter11'] ?></td>
                        <td><?= $pro['parameter12'] ?></td>
                        <td><?= $pro['parameter13'] ?></td>
                        <td><?= $pro['parameter14'] ?></td>
                        <td><?= $pro['parameter15'] ?></td>
                        <td><?= $pro['parameter16'] ?></td>
                        <td><?= $pro['parameter17'] ?></td>
                        <td><?= $pro['parameter18'] ?></td>
                        <td><?= $pro['parameter19'] ?></td>
                        <td><?= $pro['parameter20'] ?></td>
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
                      <td colspan="23">No Record Found</td>
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

    // filter only by Product Type Name (1st column)
    function filterByTypeName() {
      const term = $('#searchProductTypes').val().toLowerCase();
      $('#productTypesTable tbody tr').each(function () {
        const typeName = $(this).find('td:nth-child(1)').text().toLowerCase();
        $(this).toggle(typeName.indexOf(term) !== -1);
      });
    }
    $('#searchProductTypes').on('keyup', filterByTypeName);
    filterByTypeName();
  });
</script>


<?php include('includes/footer.php'); ?>