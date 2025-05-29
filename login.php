<?php
include('includes/header.php');
?>

<?php
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>
<div class="section">
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
                include('admin/message.php');
                ?>
                <div class="card my-5">
                    <div class="card-header custom-bg">
                        <center><h5 class="text-white">Login Form</h5></center>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            <div class="form-group">
                                <lable for="">email Id</lable>
                                <input type="text" name="email" class="form-control" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <lable for="">Password</lable>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="login_btn" class="btn button-bg1 btn-block text-white">Login</button>
                                <a href="forget_pass.php" class="text-dark">Forget Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?> 