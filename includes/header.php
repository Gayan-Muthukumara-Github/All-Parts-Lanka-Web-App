<?php
session_start();
include('config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>APL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/style-starter.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/shop-by-category.css">
  <link rel="stylesheet" href="css/faqs.css">
  <!-- password style -->
  <link rel="stylesheet" href="css/password.css">
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/product-single.css">
  <!-- Add Font Awesome for WhatsApp icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
        .custom-bg {
            background-color: #2B2D41 !important;
        }
        .button-bg1 {
            background-color: #D80027 !important;
        }
        .topic-color{
            color:#D80027 !important;
        }
        .topic-color1{
            color:#2B2D41 !important;
        }

        .btn-outline-dark {
            color: #2B2D41; 
            border-color: #2B2D41;
            background-color:rgb(255, 255, 255);
            transition: all 0.3s ease-in-out; 
        }

        .btn-outline-dark:hover,
        .btn-outline-dark:focus {
            color:rgb(255, 255, 255); 
            background-color: #D80027; 
            border-color: #D80027;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }

        .btn-outline-dark:active {
            background-color: #343a40 !important;
            border-color: #343a40 !important;
        }

    </style>
</head>
<body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-1 text-left">
              <div class="site-logo">
                <img src="images/companylogo.png" class="w-40 p-3" style="width:250px;" alt="User Image">
              </div>
            </div>

            <div class="col-6 col-md-4 order-2 order-md-2 site-search-icon text-center">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li>
                    <h5>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        echo "Hello " . $_SESSION['auth_user']['user_name'];
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </h5>
                  </li>
                  <li>

                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-person"></span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="code.php" method="POST">
                          <button type="submit" name="login_btn" class="dropdown-item">Login</button>
                          <button type="submit" name="signup_btn" class="dropdown-item">Sign Up</button>
                          <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                          <button type="submit" name="myorder_btn" class="dropdown-item">My Orders</button>
                        </form>
                      </div>
                    </div>



                  </li>
                  <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                  <li>
                    <a class="site-cart" href="cart.php">
                      <span class="icon icon-shopping_cart"></span>
                      <span id="cart-item" class="count button-bg1 text-white"></span>
                    </a>
                  </li>
                  <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="logincode.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="User Name">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Sign Up</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="code.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <span class="email_error"></span>
                  <input type="email" name="email" class="form-control email_id" placeholder="Email">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Sign Up</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <nav class="site-navigation text-right text-md-center custom-bg" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="index.php" class="text-light">HOME</a></li>
            <li><a href="product.php" class="text-light">SHOP</a></li>
            <li><a href="aboutus.php" class="text-light">ABOUT US</a></li>
            <li><a href="contactus.php" class="text-light">CONTACT US</a></li>
            <li><a href="trackorder.php" class="text-light">TRACK ORDER</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- Include WhatsApp Chat -->
    <?php include('whatsapp-chat.php'); ?>
  </div>

</body>
</html>