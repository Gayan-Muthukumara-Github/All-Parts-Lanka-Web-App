<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../admin/index.php" class="brand-link text-center">
    <div class="image">
      <img src="assets/dist/img/titlelogo.png" class="w-75 p-3" alt="User Image">
    </div>
    <span class="brand-text font-weight-light">ALL PARTS LANKA</span>
  </a>


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="assets/dist/img/logo.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">#Name - Owner</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="./index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./brand.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./producttype.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./product.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./feedback.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Feedback Table</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./orders.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orders Table</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./orderdetails.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Order Details Table</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="./adminprofile.php" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>
              Admin Profile
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./registered.php" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>
              Registered Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./manage_background.php" class="nav-link">
            <i class="nav-icon fas fa-images"></i>
            <p>
              Manage Background
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>