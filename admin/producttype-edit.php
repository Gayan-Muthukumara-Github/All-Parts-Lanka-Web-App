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
            <li class="breadcrumb-item active">Edit - Product Type</li>
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
                Edit - Product Type
              </h3>
              <a href="categoryprice.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['producttype_id'])) {
                        $producttype_id = $_GET['producttype_id'];
                        $query = "SELECT * FROM producttype WHERE producttype_id ='$producttype_id' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="producttype_id" value="<?php echo $row['producttype_id'] ?>">
                            <div class="form-group">
                              <lable for="">Product Type Name</lable>
                              <input type="text" name="producttype_name" value="<?php echo $row['producttype_name'] ?>" class="form-control" placeholder="Product Type Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 1</lable>
                              <input type="text" name="parameter1" value="<?php echo $row['parameter1'] ?>" class="form-control" placeholder="Parameter 1">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 2</lable>
                              <input type="text" name="parameter2" value="<?php echo $row['parameter2'] ?>" class="form-control" placeholder="Parameter 2">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 3</lable>
                              <input type="text" name="parameter3" value="<?php echo $row['parameter3'] ?>" class="form-control" placeholder="Parameter 3">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 4</lable>
                              <input type="text" name="parameter4" value="<?php echo $row['parameter4'] ?>" class="form-control" placeholder="Parameter 4">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 5</lable>
                              <input type="text" name="parameter5" value="<?php echo $row['parameter5'] ?>" class="form-control" placeholder="Parameter 5">
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
                      <button type="submit" name="editProductType" class="btn btn-info">Update</button>
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