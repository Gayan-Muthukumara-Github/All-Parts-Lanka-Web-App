<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<?php
// Dashboard Metrics
include('config/dbcon.php');

function fetch_scalar($con, $sql, $types = '', ...$params) {
  $stmt = mysqli_prepare($con, $sql);
  if ($stmt) {
    if ($types !== '' && !empty($params)) {
      mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res) {
      $row = mysqli_fetch_row($res);
      return $row ? (is_null($row[0]) ? 0 : $row[0]) : 0;
    }
  }
  return 0;
}

$totalOrders = fetch_scalar($con, "SELECT COUNT(*) FROM orders");
$totalRevenue = fetch_scalar($con, "SELECT COALESCE(SUM(total_price),0) FROM orders");
$pendingOrders = fetch_scalar($con, "SELECT COUNT(*) FROM orders WHERE status='Pending'");
$todaysOrders = fetch_scalar($con, "SELECT COUNT(*) FROM orders WHERE order_date = CURDATE()");

$totalUsers = fetch_scalar($con, "SELECT COUNT(*) FROM users");
// Check for created_at column to compute new users this month
$hasCreatedAt = false;
$colChk = mysqli_query($con, "SHOW COLUMNS FROM users LIKE 'created_at'");
if ($colChk && mysqli_num_rows($colChk) > 0) { $hasCreatedAt = true; }
$newUsersThisMonth = $hasCreatedAt
  ? fetch_scalar($con, "SELECT COUNT(*) FROM users WHERE DATE_FORMAT(created_at,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')")
  : null;

$totalFeedback = fetch_scalar($con, "SELECT COUNT(*) FROM feedback");

$totalProducts = fetch_scalar($con, "SELECT COUNT(*) FROM product");
$productTypes = fetch_scalar($con, "SELECT COUNT(*) FROM producttype");
$brandsCount = fetch_scalar($con, "SELECT COUNT(*) FROM brand");

$deliveryDueToday = fetch_scalar($con, "SELECT COUNT(*) FROM orders WHERE due_date = CURDATE()");

// Top selling products
$topProducts = [];
$tpSql = "SELECT p.product_name, SUM(o.quantity) AS total_qty
          FROM orders o
          JOIN product p ON o.product_id = p.product_id
          GROUP BY p.product_id, p.product_name
          ORDER BY total_qty DESC
          LIMIT 5";
$tpRes = mysqli_query($con, $tpSql);
if ($tpRes && mysqli_num_rows($tpRes) > 0) {
  while ($r = mysqli_fetch_assoc($tpRes)) { $topProducts[] = $r; }
}

// Latest active feedback
$latestFeedback = [];
$lfSql = "SELECT f.feedback_ID, f.f_description, u.username
          FROM feedback f
          JOIN users u ON f.user_ID = u.user_ID
          WHERE IFNULL(f.status,1)=1
          ORDER BY f.feedback_ID DESC
          LIMIT 5";
$lfRes = mysqli_query($con, $lfSql);
if ($lfRes && mysqli_num_rows($lfRes) > 0) {
  while ($r = mysqli_fetch_assoc($lfRes)) { $latestFeedback[] = $r; }
}

// Orders by district
$ordersByDistrict = [];
$obdSql = "SELECT district, COUNT(*) AS cnt FROM orders GROUP BY district ORDER BY cnt DESC LIMIT 10";
$obdRes = mysqli_query($con, $obdSql);
if ($obdRes && mysqli_num_rows($obdRes) > 0) {
  while ($r = mysqli_fetch_assoc($obdRes)) { $ordersByDistrict[] = $r; }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php');  ?>
        </div>
        <!-- Orders & Sales -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= number_format($totalOrders) ?></h3>
              <p>Total Orders</p>
            </div>
            <div class="icon"><i class="ion ion-bag"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>Rs. <?= number_format($totalRevenue, 2) ?></h3>
              <p>Total Revenue</p>
            </div>
            <div class="icon"><i class="ion ion-stats-bars"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= number_format($pendingOrders) ?></h3>
              <p>Pending Orders</p>
            </div>
            <div class="icon"><i class="ion ion-alert"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?= number_format($todaysOrders) ?></h3>
              <p>Today's Orders</p>
            </div>
            <div class="icon"><i class="ion ion-clock"></i></div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Users & Feedback -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3><?= number_format($totalUsers) ?></h3>
              <p>Total Users</p>
            </div>
            <div class="icon"><i class="ion ion-person"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-light">
            <div class="inner">
              <h3><?= is_null($newUsersThisMonth) ? 'N/A' : number_format($newUsersThisMonth) ?></h3>
              <p>New Users (This Month)</p>
            </div>
            <div class="icon"><i class="ion ion-person-add"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= number_format($totalFeedback) ?></h3>
              <p>Total Feedback</p>
            </div>
            <div class="icon"><i class="ion ion-chatbubbles"></i></div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= number_format($deliveryDueToday) ?></h3>
              <p>Delivery Due Today</p>
            </div>
            <div class="icon"><i class="ion ion-android-bus"></i></div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Products -->
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header"><h5 class="m-0">Products Overview</h5></div>
            <div class="card-body">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Total Products
                  <span class="badge badge-primary badge-pill"><?= number_format($totalProducts) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Product Types
                  <span class="badge badge-primary badge-pill"><?= number_format($productTypes) ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Brands Available
                  <span class="badge badge-primary badge-pill"><?= number_format($brandsCount) ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Top Selling Products -->
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header"><h5 class="m-0">Top Selling Products</h5></div>
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <thead>
                  <tr><th>Product</th><th class="text-right">Qty</th></tr>
                </thead>
                <tbody>
                  <?php if (!empty($topProducts)): foreach ($topProducts as $tp): ?>
                    <tr>
                      <td><?= htmlspecialchars($tp['product_name']) ?></td>
                      <td class="text-right"><?= number_format($tp['total_qty']) ?></td>
                    </tr>
                  <?php endforeach; else: ?>
                    <tr><td colspan="2" class="text-center">No data</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Latest Feedback -->
        <div class="col-lg-4 col-12">
          <div class="card">
            <div class="card-header"><h5 class="m-0">Latest Feedback</h5></div>
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <thead>
                  <tr><th>User</th><th>Feedback</th></tr>
                </thead>
                <tbody>
                  <?php if (!empty($latestFeedback)): foreach ($latestFeedback as $fb): ?>
                    <tr>
                      <td><?= htmlspecialchars($fb['username']) ?></td>
                      <td><?= htmlspecialchars($fb['f_description']) ?></td>
                    </tr>
                  <?php endforeach; else: ?>
                    <tr><td colspan="2" class="text-center">No feedback</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Orders by District -->
        <div class="col-lg-6 col-12">
          <div class="card">
            <div class="card-header"><h5 class="m-0">Orders by District</h5></div>
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <thead>
                  <tr><th>District</th><th class="text-right">Orders</th></tr>
                </thead>
                <tbody>
                  <?php if (!empty($ordersByDistrict)): foreach ($ordersByDistrict as $d): ?>
                    <tr>
                      <td><?= htmlspecialchars($d['district']) ?></td>
                      <td class="text-right"><?= number_format($d['cnt']) ?></td>
                    </tr>
                  <?php endforeach; else: ?>
                    <tr><td colspan="2" class="text-center">No data</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>