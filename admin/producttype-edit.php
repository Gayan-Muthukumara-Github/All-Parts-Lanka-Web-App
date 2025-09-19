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
                            <div class="form-group">
                              <lable for="">Parameter 6</lable>
                              <input type="text" name="parameter6" value="<?php echo $row['parameter6'] ?>" class="form-control" placeholder="Parameter 6">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 7</lable>
                              <input type="text" name="parameter7" value="<?php echo $row['parameter7'] ?>" class="form-control" placeholder="Parameter 7">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 8</lable>
                              <input type="text" name="parameter8" value="<?php echo $row['parameter8'] ?>" class="form-control" placeholder="Parameter 8">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 9</lable>
                              <input type="text" name="parameter9" value="<?php echo $row['parameter9'] ?>" class="form-control" placeholder="Parameter 9">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 10</lable>
                              <input type="text" name="parameter10" value="<?php echo $row['parameter10'] ?>" class="form-control" placeholder="Parameter 10">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 11</lable>
                              <input type="text" name="parameter11" value="<?php echo $row['parameter11'] ?>" class="form-control" placeholder="Parameter 11">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 12</lable>
                              <input type="text" name="parameter12" value="<?php echo $row['parameter12'] ?>" class="form-control" placeholder="Parameter 12">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 13</lable>
                              <input type="text" name="parameter13" value="<?php echo $row['parameter13'] ?>" class="form-control" placeholder="Parameter 13">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 14</lable>
                              <input type="text" name="parameter14" value="<?php echo $row['parameter14'] ?>" class="form-control" placeholder="Parameter 14">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 15</lable>
                              <input type="text" name="parameter15" value="<?php echo $row['parameter15'] ?>" class="form-control" placeholder="Parameter 15">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 16</lable>
                              <input type="text" name="parameter16" value="<?php echo $row['parameter16'] ?>" class="form-control" placeholder="Parameter 16">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 17</lable>
                              <input type="text" name="parameter17" value="<?php echo $row['parameter17'] ?>" class="form-control" placeholder="Parameter 17">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 18</lable>
                              <input type="text" name="parameter18" value="<?php echo $row['parameter18'] ?>" class="form-control" placeholder="Parameter 18">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 19</lable>
                              <input type="text" name="parameter19" value="<?php echo $row['parameter19'] ?>" class="form-control" placeholder="Parameter 19">
                            </div>
                            <div class="form-group">
                              <lable for="">Parameter 20</lable>
                              <input type="text" name="parameter20" value="<?php echo $row['parameter20'] ?>" class="form-control" placeholder="Parameter 20">
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