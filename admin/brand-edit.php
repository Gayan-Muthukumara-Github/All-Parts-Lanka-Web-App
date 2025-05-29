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
            <li class="breadcrumb-item active">Edit - Brand</li>
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
                Edit - Brand
              </h3>
              <a href="brand.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="code.php" method="POST" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
                            <div class="modal-body">
                                <?php
                                if (isset($_GET['brand_id'])) {
                                    $Brand_id = $_GET['brand_id'];
                                    $query = "SELECT * FROM brand WHERE brand_id ='$Brand_id' LIMIT 1";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                ?>
                                            <input type="hidden" name="brand_id" value="<?php echo $row['brand_id'] ?>">
                                            <div class="form-group">
                                                <label for="">Brand ID</label>
                                                <input type="text" name="brand_id" value="<?php echo $row['brand_id'] ?>" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Brand Name</label>
                                                <input type="text" name="brand_name" value="<?php echo $row['brand_name'] ?>" class="form-control" placeholder="Brand Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Brand Image</label>
                                                <input type="file" name="brand_image" class="form-control">
                                                <!-- Display Existing Image -->
                                                <br>
                                                <?php
                                                if (!empty($row['brand_image'])) {
                                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['brand_image']) . '" width="100" height="100"/>';
                                                } else {
                                                    echo "No Image Available";
                                                }
                                                ?>
                                                <input type="hidden" name="existing_image" value="<?php echo base64_encode($row['brand_image']); ?>">
                                            </div>
                                <?php
                                        }
                                    } else {
                                        echo "<h4>No Record Found.!</h4>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="editBrand" class="btn btn-info">Update</button>
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