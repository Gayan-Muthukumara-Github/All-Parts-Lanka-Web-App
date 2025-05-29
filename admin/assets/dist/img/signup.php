<?php
session_start();
include('includes/header.php');
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>

<div class="section" style="background-image: url('assets/dist/img/bgimage_2.jpg'); height:1000px;" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <?php
                if (isset($_SESSION['auth_status'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?php echo $_SESSION['auth_status']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['auth_status']);
                }

                ?>

                <?php
                include('message.php');
                ?>
                
                <div class="card my-5">
                    <div class="card-header bg-warning">
                        <h5>Sign Up Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <lable for="">First Name</lable>
                                    <input type="text" name="firstname" class="form-control" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <lable for="">Last Name</lable>
                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <lable for="">User Name</lable>
                                <input type="text" name="username" class="form-control" placeholder="User Name">
                            </div>
                            <div class="form-group">
                                <lable for="">Phone Number</lable>
                                <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <lable for="">Address</lable>
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <lable for="">Email</lable>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <lable for="">Password</lable>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <lable for="">Confirm Password</lable>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="addUser_website" class="btn btn-dark btn-block">Sign Up</button>
                            </div>
                            <div class="form-group">
                                <lable for="">Already have an account?<a href="login.php"> Login</a></lable>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/script.php'); ?>