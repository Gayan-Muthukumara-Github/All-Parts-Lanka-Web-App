<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<!--Add Background-->
<div class="modal fade" id="AddBackground" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Background Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Image Name</label>
            <input type="text" name="image_name" class="form-control" placeholder="Enter Image Name" required>
          </div>
          <div class="form-group">
            <label for="">Background Image</label>
            <input type="file" name="background_image" id="background_image" class="form-control btn-sm" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="save_background" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Delete Background-->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Background Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_background" class="delete_background">
          <p>
            Are you sure you want to delete this background image?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Yes, Delete!</button>
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
                                Background Images
                                <a href="#" data-toggle="modal" data-target="#AddBackground" class="btn btn-primary float-right">Add Background</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image Name</th>
                                        <th>Preview</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM background_images ORDER BY created_at DESC";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $image) {
                                    ?>
                                            <tr>
                                                <td><?= $image['id'] ?></td>
                                                <td><?= $image['image_name'] ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($image['image_data'])) {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($image['image_data']) . '" width="200" height="100" style="object-fit: cover;"/>';
                                                    } else {
                                                        echo "No Image";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="toggle_background_status" value="<?= $image['id'] ?>" 
                                                                class="btn <?= $image['status'] ? 'btn-success' : 'btn-warning' ?> btn-sm">
                                                            <?= $image['status'] ? 'Active' : 'Inactive' ?>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td><?= $image['created_at'] ?></td>
                                                <td>
                                                    <button type="button" value="<?= $image['id'] ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
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
      var image_id = $(this).val();
      $('.delete_background').val(image_id);
      $('#DeleteModal').modal('show');
    });
  });
</script>

<?php include('includes/footer.php'); ?>